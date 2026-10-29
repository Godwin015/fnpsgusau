<?php

namespace Tests\Feature;

use App\Models\AcademicSession;
use App\Models\ClassLevel;
use App\Models\ClassTermPublication;
use App\Models\Enrollment;
use App\Models\FeeStatusAudit;
use App\Models\ResultPublicationAudit;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentFeeStatus;
use App\Models\StudentResult;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeeAndResultPublicationTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected AcademicSession $session;

    protected ClassLevel $classLevel;

    protected Section $section;

    protected Subject $subject;

    protected Student $student;

    protected Enrollment $enrollment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->session = AcademicSession::create([
            'name' => '2025/2026',
            'start_date' => '2025-09-01',
            'end_date' => '2026-07-31',
            'is_current' => false,
        ]);

        $this->classLevel = ClassLevel::create([
            'name' => 'Primary 2',
            'code' => 'P2',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $this->section = Section::create([
            'class_level_id' => $this->classLevel->id,
            'name' => 'Green',
            'is_active' => true,
        ]);

        $this->subject = Subject::create([
            'name' => 'Mathematics',
            'code' => 'FEE-MATH',
            'is_active' => true,
        ]);

        $this->classLevel->subjects()->attach($this->subject->id);

        $this->student = Student::create([
            'admission_number' => 'FNPS-FEE-001',
            'first_name' => 'Fee',
            'last_name' => 'Test',
            'status' => 'active',
        ]);

        $this->enrollment = Enrollment::create([
            'student_id' => $this->student->id,
            'academic_session_id' => $this->session->id,
            'section_id' => $this->section->id,
            'promotion_status' => 'pending',
            'enrollment_status' => 'enrolled',
        ]);

        $this->admin = User::factory()->create([
            'role' => 'super_admin',
            'student_id' => null,
        ]);
    }

    protected function createCompleteResult(
        Enrollment $enrollment,
        string $term = 'First Term'
    ): StudentResult {
        return StudentResult::create([
            'enrollment_id' => $enrollment->id,
            'subject_id' => $this->subject->id,
            'term' => $term,
            'first_assessment' => 18,
            'second_assessment' => 19,
            'exam' => 55,
            'entered_by' => null,
            'status' => 'submitted',
            'published_at' => null,
        ]);
    }

    protected function updateFeeStatus(
        Enrollment $enrollment,
        string $term,
        string $status
    ) {
        return $this->actingAs($this->admin)->post(
            route('staff-management.fee-statuses.update', $enrollment),
            [
                'term' => $term,
                'status' => $status,
                'session_id' => $this->session->id,
                'section_id' => $this->section->id,
            ]
        );
    }

    protected function publishTerm(string $term = 'First Term')
    {
        return $this->actingAs($this->admin)->post(
            route('staff-management.class-term-publication.publish'),
            [
                'session_id' => $this->session->id,
                'section_id' => $this->section->id,
                'term' => $term,
            ]
        );
    }

    protected function createSecondEnrollment(
        string $admissionNumber
    ): Enrollment {
        $student = Student::create([
            'admission_number' => $admissionNumber,
            'first_name' => 'Another',
            'last_name' => 'Pupil',
            'status' => 'active',
        ]);

        return Enrollment::create([
            'student_id' => $student->id,
            'academic_session_id' => $this->session->id,
            'section_id' => $this->section->id,
            'promotion_status' => 'pending',
            'enrollment_status' => 'enrolled',
        ]);
    }

    public function test_fee_status_update_creates_audit_record(): void
    {
        $response = $this->updateFeeStatus(
            $this->enrollment,
            'First Term',
            StudentFeeStatus::PAID
        );

        $response->assertRedirect();

        $this->assertDatabaseHas('student_fee_statuses', [
            'enrollment_id' => $this->enrollment->id,
            'term' => 'First Term',
            'status' => StudentFeeStatus::PAID,
            'updated_by' => $this->admin->id,
        ]);

        $this->assertDatabaseHas('fee_status_audits', [
            'enrollment_id' => $this->enrollment->id,
            'term' => 'First Term',
            'old_status' => null,
            'new_status' => StudentFeeStatus::PAID,
            'changed_by' => $this->admin->id,
        ]);
    }

    public function test_changing_fee_status_preserves_existing_result(): void
    {
        $result = $this->createCompleteResult($this->enrollment);

        $this->updateFeeStatus(
            $this->enrollment,
            'First Term',
            StudentFeeStatus::PAID
        )->assertRedirect();

        $this->updateFeeStatus(
            $this->enrollment,
            'First Term',
            StudentFeeStatus::NOT_PAID
        )->assertRedirect();

        $this->assertDatabaseHas('student_results', [
            'id' => $result->id,
            'enrollment_id' => $this->enrollment->id,
            'first_assessment' => 18,
            'second_assessment' => 19,
            'exam' => 55,
        ]);

        $this->assertDatabaseHas('fee_status_audits', [
            'enrollment_id' => $this->enrollment->id,
            'term' => 'First Term',
            'old_status' => StudentFeeStatus::PAID,
            'new_status' => StudentFeeStatus::NOT_PAID,
        ]);
    }

    public function test_fee_status_is_separate_for_each_term(): void
    {
        $this->updateFeeStatus(
            $this->enrollment,
            'First Term',
            StudentFeeStatus::PAID
        )->assertRedirect();

        $this->updateFeeStatus(
            $this->enrollment,
            'Second Term',
            StudentFeeStatus::NOT_PAID
        )->assertRedirect();

        $this->assertDatabaseHas('student_fee_statuses', [
            'enrollment_id' => $this->enrollment->id,
            'term' => 'First Term',
            'status' => StudentFeeStatus::PAID,
        ]);

        $this->assertDatabaseHas('student_fee_statuses', [
            'enrollment_id' => $this->enrollment->id,
            'term' => 'Second Term',
            'status' => StudentFeeStatus::NOT_PAID,
        ]);

        $this->assertDatabaseCount('fee_status_audits', 2);
    }

    public function test_publication_excludes_unpaid_pupils_and_incomplete_results(): void
    {
        // Pupil 1: Paid and complete.
        $eligible = $this->enrollment;

        StudentFeeStatus::create([
            'enrollment_id' => $eligible->id,
            'term' => 'First Term',
            'status' => StudentFeeStatus::PAID,
        ]);

        $eligibleResult = $this->createCompleteResult($eligible);

        // Pupil 2: Not Paid, but complete.
        $unpaid = $this->createSecondEnrollment('FNPS-FEE-002');

        StudentFeeStatus::create([
            'enrollment_id' => $unpaid->id,
            'term' => 'First Term',
            'status' => StudentFeeStatus::NOT_PAID,
        ]);

        $unpaidResult = $this->createCompleteResult($unpaid);

        // Pupil 3: Paid, but missing a required result.
        $incomplete = $this->createSecondEnrollment('FNPS-FEE-003');

        StudentFeeStatus::create([
            'enrollment_id' => $incomplete->id,
            'term' => 'First Term',
            'status' => StudentFeeStatus::PAID,
        ]);

        // No result is created for this pupil.

        $response = $this->publishTerm();

        $response->assertRedirect();

        $this->assertDatabaseHas('class_term_publications', [
            'academic_session_id' => $this->session->id,
            'section_id' => $this->section->id,
            'term' => 'First Term',
            'is_published' => true,
        ]);

        // Only the eligible pupil receives publication timestamps.
        $this->assertNotNull(
            $eligibleResult->fresh()->published_at
        );

        $this->assertNull(
            $unpaidResult->fresh()->published_at
        );

        $this->assertNull(
            StudentResult::where('enrollment_id', $incomplete->id)
                ->where('term', 'First Term')
                ->first()
        );

        $this->assertDatabaseHas('result_publication_audits', [
            'academic_session_id' => $this->session->id,
            'section_id' => $this->section->id,
            'term' => 'First Term',
            'action' => 'published',
            'performed_by' => $this->admin->id,
            'eligible_count' => 1,
            'excluded_count' => 2,
        ]);
    }

    public function test_unpublishing_clears_only_selected_term_results(): void
    {
        $firstTermResult = $this->createCompleteResult(
            $this->enrollment,
            'First Term'
        );

        $secondTermResult = $this->createCompleteResult(
            $this->enrollment,
            'Second Term'
        );

        StudentFeeStatus::create([
            'enrollment_id' => $this->enrollment->id,
            'term' => 'First Term',
            'status' => StudentFeeStatus::PAID,
        ]);

        StudentFeeStatus::create([
            'enrollment_id' => $this->enrollment->id,
            'term' => 'Second Term',
            'status' => StudentFeeStatus::PAID,
        ]);

        $this->publishTerm('First Term')->assertRedirect();

        // Publish Second Term separately.
        $this->actingAs($this->admin)->post(
            route('staff-management.class-term-publication.publish'),
            [
                'session_id' => $this->session->id,
                'section_id' => $this->section->id,
                'term' => 'Second Term',
            ]
        )->assertRedirect();

        $this->assertNotNull($firstTermResult->fresh()->published_at);
        $this->assertNotNull($secondTermResult->fresh()->published_at);

        $this->actingAs($this->admin)->post(
            route('staff-management.class-term-publication.unpublish'),
            [
                'session_id' => $this->session->id,
                'section_id' => $this->section->id,
                'term' => 'First Term',
            ]
        )->assertRedirect();

        $this->assertNull(
            $firstTermResult->fresh()->published_at
        );

        $this->assertNotNull(
            $secondTermResult->fresh()->published_at
        );

        $this->assertDatabaseHas('result_publication_audits', [
            'academic_session_id' => $this->session->id,
            'section_id' => $this->section->id,
            'term' => 'First Term',
            'action' => 'unpublished',
            'performed_by' => $this->admin->id,
        ]);
    }


    public function test_pupil_becomes_eligible_after_fee_is_paid_without_republishing_class(): void
    {
        // The pupil has complete scores but has not paid.
        $result = $this->createCompleteResult($this->enrollment);

        StudentFeeStatus::create([
            'enrollment_id' => $this->enrollment->id,
            'term' => 'First Term',
            'status' => StudentFeeStatus::NOT_PAID,
        ]);

        // Publish the class while this pupil is unpaid.
        $this->publishTerm('First Term')->assertRedirect();

        // The class publication exists, but the pupil is excluded.
        $this->assertDatabaseHas('class_term_publications', [
            'academic_session_id' => $this->session->id,
            'section_id' => $this->section->id,
            'term' => 'First Term',
            'is_published' => true,
        ]);

        $this->assertNull($result->fresh()->published_at);

        // Change the pupil's fee status to Paid.
        $this->updateFeeStatus(
            $this->enrollment,
            'First Term',
            StudentFeeStatus::PAID
        )->assertRedirect();

        // The pupil should now become eligible without republishing.
        $this->assertNotNull(
            $result->fresh()->published_at,
            'The pupil has paid, but their result was not automatically made available.'
        );
    }

}
