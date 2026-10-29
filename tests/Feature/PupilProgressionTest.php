<?php

namespace Tests\Feature;

use App\Models\AcademicSession;
use App\Models\ClassLevel;
use App\Models\Subject;
use App\Models\StudentResult;
use App\Models\Enrollment;
use App\Models\PupilProgressionAudit;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PupilProgressionTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected Student $student;

    protected AcademicSession $sourceSession;

    protected AcademicSession $destinationSession;

    protected ClassLevel $primaryOne;

    protected ClassLevel $primaryTwo;

    protected ClassLevel $primaryThree;

    protected Section $sourceSection;

    protected Section $sameLevelSection;

    protected Section $higherSection;

    protected Section $lowerSection;

    protected Enrollment $sourceEnrollment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'super_admin',
            'student_id' => null,
            'must_change_password' => false,
        ]);

        $this->actingAs($this->admin);

        $this->sourceSession = AcademicSession::create([
            'name' => '2025/2026',
            'start_date' => '2025-09-01',
            'end_date' => '2026-07-31',
            'is_current' => false,
        ]);

        $this->destinationSession = AcademicSession::create([
            'name' => '2026/2027',
            'start_date' => '2026-09-01',
            'end_date' => '2027-07-31',
            'is_current' => false,
        ]);

        $this->primaryOne = ClassLevel::create([
            'name' => 'Primary 1',
            'code' => 'P1',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->primaryTwo = ClassLevel::create([
            'name' => 'Primary 2',
            'code' => 'P2',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $this->primaryThree = ClassLevel::create([
            'name' => 'Primary 3',
            'code' => 'P3',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        $this->sourceSection = Section::create([
            'class_level_id' => $this->primaryTwo->id,
            'name' => 'Green',
            'is_active' => true,
        ]);

        $this->sameLevelSection = Section::create([
            'class_level_id' => $this->primaryTwo->id,
            'name' => 'Blue',
            'is_active' => true,
        ]);

        $this->higherSection = Section::create([
            'class_level_id' => $this->primaryThree->id,
            'name' => 'Green',
            'is_active' => true,
        ]);

        $this->lowerSection = Section::create([
            'class_level_id' => $this->primaryOne->id,
            'name' => 'Green',
            'is_active' => true,
        ]);

        $this->student = Student::create([
            'admission_number' => 'FNPS-TEST-001',
            'first_name' => 'Test',
            'last_name' => 'Pupil',
            'status' => 'active',
        ]);

        $this->sourceEnrollment = Enrollment::create([
            'student_id' => $this->student->id,
            'academic_session_id' => $this->sourceSession->id,
            'section_id' => $this->sourceSection->id,
            'promotion_status' => 'pending',
            'enrollment_status' => 'enrolled',
        ]);
    }

    public function test_super_admin_can_promote_a_pupil_and_audit_is_created(): void
    {
        $response = $this->post(route('pupil-progression.store'), [
            'student_id' => $this->student->id,
            'source_enrollment_id' => $this->sourceEnrollment->id,
            'action' => 'promote',
            'destination_session_id' => $this->destinationSession->id,
            'destination_section_id' => $this->higherSection->id,
            'note' => 'Automated promotion test',
        ]);

        $response->assertRedirect(route('pupil-progression.index'));

        $this->assertDatabaseHas('enrollments', [
            'student_id' => $this->student->id,
            'academic_session_id' => $this->destinationSession->id,
            'section_id' => $this->higherSection->id,
            'promotion_status' => 'promoted',
            'enrollment_status' => 'enrolled',
        ]);

        $this->assertDatabaseHas('enrollments', [
            'id' => $this->sourceEnrollment->id,
            'promotion_status' => 'promoted',
            'enrollment_status' => 'completed',
        ]);

        $this->assertDatabaseHas('pupil_progression_audits', [
            'student_id' => $this->student->id,
            'source_enrollment_id' => $this->sourceEnrollment->id,
            'source_session_id' => $this->sourceSession->id,
            'destination_session_id' => $this->destinationSession->id,
            'source_section_id' => $this->sourceSection->id,
            'destination_section_id' => $this->higherSection->id,
            'action' => 'promote',
            'note' => 'Automated promotion test',
            'performed_by' => $this->admin->id,
        ]);
    }

    public function test_super_admin_can_repeat_a_pupil_in_the_same_class_level(): void
    {
        $response = $this->post(route('pupil-progression.store'), [
            'student_id' => $this->student->id,
            'source_enrollment_id' => $this->sourceEnrollment->id,
            'action' => 'repeat',
            'destination_session_id' => $this->destinationSession->id,
            'destination_section_id' => $this->sameLevelSection->id,
            'note' => 'Automated repetition test',
        ]);

        $response->assertRedirect(route('pupil-progression.index'));

        $this->assertDatabaseHas('enrollments', [
            'student_id' => $this->student->id,
            'academic_session_id' => $this->destinationSession->id,
            'section_id' => $this->sameLevelSection->id,
            'promotion_status' => 'repeated',
            'enrollment_status' => 'enrolled',
        ]);

        $this->assertDatabaseHas('pupil_progression_audits', [
            'student_id' => $this->student->id,
            'action' => 'repeat',
            'performed_by' => $this->admin->id,
        ]);
    }

    public function test_super_admin_can_demote_a_pupil_to_a_lower_class_level(): void
    {
        $response = $this->post(route('pupil-progression.store'), [
            'student_id' => $this->student->id,
            'source_enrollment_id' => $this->sourceEnrollment->id,
            'action' => 'demote',
            'destination_session_id' => $this->destinationSession->id,
            'destination_section_id' => $this->lowerSection->id,
            'note' => 'Automated demotion test',
        ]);

        $response->assertRedirect(route('pupil-progression.index'));

        $this->assertDatabaseHas('enrollments', [
            'student_id' => $this->student->id,
            'academic_session_id' => $this->destinationSession->id,
            'section_id' => $this->lowerSection->id,
            'promotion_status' => 'demoted',
            'enrollment_status' => 'enrolled',
        ]);

        $this->assertDatabaseHas('pupil_progression_audits', [
            'student_id' => $this->student->id,
            'action' => 'demote',
            'performed_by' => $this->admin->id,
        ]);
    }

    public function test_super_admin_can_transfer_a_pupil_and_audit_is_created(): void
    {
        $response = $this->post(route('pupil-progression.store'), [
            'student_id' => $this->student->id,
            'source_enrollment_id' => $this->sourceEnrollment->id,
            'action' => 'transfer',
            'destination_session_id' => $this->sourceSession->id,
            'destination_section_id' => $this->sameLevelSection->id,
            'note' => 'Automated transfer test',
        ]);

        $response->assertRedirect(route('pupil-progression.index'));

        $this->assertDatabaseHas('enrollments', [
            'id' => $this->sourceEnrollment->id,
            'section_id' => $this->sameLevelSection->id,
            'enrollment_status' => 'enrolled',
        ]);

        $this->assertDatabaseHas('pupil_progression_audits', [
            'student_id' => $this->student->id,
            'source_enrollment_id' => $this->sourceEnrollment->id,
            'destination_enrollment_id' => $this->sourceEnrollment->id,
            'source_session_id' => $this->sourceSession->id,
            'destination_session_id' => $this->sourceSession->id,
            'source_section_id' => $this->sourceSection->id,
            'destination_section_id' => $this->sameLevelSection->id,
            'action' => 'transfer',
            'note' => 'Automated transfer test',
            'performed_by' => $this->admin->id,
        ]);
    }

    public function test_promotion_to_same_class_level_is_rejected_without_audit(): void
    {
        $response = $this->from(route('pupil-progression.index'))
            ->post(route('pupil-progression.store'), [
                'student_id' => $this->student->id,
                'source_enrollment_id' => $this->sourceEnrollment->id,
                'action' => 'promote',
                'destination_session_id' => $this->destinationSession->id,
                'destination_section_id' => $this->sameLevelSection->id,
            ]);

        $response->assertRedirect(route('pupil-progression.index'));
        $response->assertSessionHasErrors('destination_section_id');

        $this->assertDatabaseCount('enrollments', 1);
        $this->assertDatabaseCount('pupil_progression_audits', 0);

        $this->assertDatabaseHas('enrollments', [
            'id' => $this->sourceEnrollment->id,
            'enrollment_status' => 'enrolled',
        ]);
    }


    public function test_progression_is_rejected_if_pupil_already_has_destination_enrollment(): void
    {
        Enrollment::create([
            'student_id' => $this->student->id,
            'academic_session_id' => $this->destinationSession->id,
            'section_id' => $this->higherSection->id,
            'promotion_status' => 'pending',
            'enrollment_status' => 'enrolled',
        ]);

        $response = $this->from(route('pupil-progression.index'))
            ->post(route('pupil-progression.store'), [
                'student_id' => $this->student->id,
                'source_enrollment_id' => $this->sourceEnrollment->id,
                'action' => 'promote',
                'destination_session_id' => $this->destinationSession->id,
                'destination_section_id' => $this->higherSection->id,
            ]);

        $response->assertRedirect(route('pupil-progression.index'));
        $response->assertSessionHasErrors('destination_session_id');

        $this->assertDatabaseCount('enrollments', 2);
        $this->assertDatabaseCount('pupil_progression_audits', 0);

        $this->assertDatabaseHas('enrollments', [
            'id' => $this->sourceEnrollment->id,
            'enrollment_status' => 'enrolled',
        ]);
    }

    public function test_completed_source_enrollment_cannot_be_progressed(): void
    {
        $this->sourceEnrollment->update([
            'enrollment_status' => 'completed',
        ]);

        $response = $this->from(route('pupil-progression.index'))
            ->post(route('pupil-progression.store'), [
                'student_id' => $this->student->id,
                'source_enrollment_id' => $this->sourceEnrollment->id,
                'action' => 'promote',
                'destination_session_id' => $this->destinationSession->id,
                'destination_section_id' => $this->higherSection->id,
            ]);

        $response->assertRedirect(route('pupil-progression.index'));
        $response->assertSessionHasErrors('source_enrollment_id');

        $this->assertDatabaseCount('enrollments', 1);
        $this->assertDatabaseCount('pupil_progression_audits', 0);

        $this->assertDatabaseHas('enrollments', [
            'id' => $this->sourceEnrollment->id,
            'enrollment_status' => 'completed',
        ]);
    }

    public function test_regular_teacher_cannot_progress_a_pupil(): void
    {
        $teacher = User::factory()->create([
            'role' => 'teacher',
            'student_id' => null,
            'must_change_password' => false,
        ]);

        $response = $this->actingAs($teacher)
            ->post(route('pupil-progression.store'), [
                'student_id' => $this->student->id,
                'source_enrollment_id' => $this->sourceEnrollment->id,
                'action' => 'promote',
                'destination_session_id' => $this->destinationSession->id,
                'destination_section_id' => $this->higherSection->id,
            ]);

        $response->assertForbidden();

        $this->assertDatabaseCount('enrollments', 1);
        $this->assertDatabaseCount('pupil_progression_audits', 0);
    }


    public function test_transfer_is_rejected_when_pupil_has_existing_results(): void
    {
        $subject = Subject::create([
            'name' => 'Mathematics',
            'code' => 'MATH-TEST',
            'is_active' => true,
        ]);

        StudentResult::create([
            'enrollment_id' => $this->sourceEnrollment->id,
            'subject_id' => $subject->id,
            'term' => 'First Term',
            'first_assessment' => 18,
            'second_assessment' => 19,
            'exam' => 55,
            'status' => 'submitted',
        ]);

        $response = $this->from(route('pupil-progression.index'))
            ->post(route('pupil-progression.store'), [
                'student_id' => $this->student->id,
                'source_enrollment_id' => $this->sourceEnrollment->id,
                'action' => 'transfer',
                'destination_session_id' => $this->sourceSession->id,
                'destination_section_id' => $this->sameLevelSection->id,
            ]);

        $response->assertRedirect(route('pupil-progression.index'));
        $response->assertSessionHasErrors();

        $this->assertDatabaseCount('pupil_progression_audits', 0);

        $this->assertDatabaseHas('student_results', [
            'enrollment_id' => $this->sourceEnrollment->id,
            'subject_id' => $subject->id,
            'term' => 'First Term',
            'first_assessment' => 18,
            'second_assessment' => 19,
            'exam' => 55,
        ]);

        $this->assertDatabaseHas('enrollments', [
            'id' => $this->sourceEnrollment->id,
            'section_id' => $this->sourceSection->id,
            'enrollment_status' => 'enrolled',
        ]);
    }

    public function test_wrong_student_and_enrollment_combination_is_rejected(): void
    {
        $anotherStudent = Student::create([
            'admission_number' => 'FNPS-TEST-002',
            'first_name' => 'Another',
            'last_name' => 'Pupil',
            'status' => 'active',
        ]);

        $response = $this->post(route('pupil-progression.store'), [
            'student_id' => $anotherStudent->id,
            'source_enrollment_id' => $this->sourceEnrollment->id,
            'action' => 'promote',
            'destination_session_id' => $this->destinationSession->id,
            'destination_section_id' => $this->higherSection->id,
        ]);

        $response->assertNotFound();

        $this->assertDatabaseCount('enrollments', 1);
        $this->assertDatabaseCount('pupil_progression_audits', 0);

        $this->assertDatabaseHas('enrollments', [
            'id' => $this->sourceEnrollment->id,
            'student_id' => $this->student->id,
            'enrollment_status' => 'enrolled',
        ]);
    }

    public function test_promotion_preserves_existing_result_history(): void
    {
        $subject = Subject::create([
            'name' => 'English',
            'code' => 'ENG-TEST',
            'is_active' => true,
        ]);

        $result = StudentResult::create([
            'enrollment_id' => $this->sourceEnrollment->id,
            'subject_id' => $subject->id,
            'term' => 'First Term',
            'first_assessment' => 17,
            'second_assessment' => 18,
            'exam' => 50,
            'status' => 'submitted',
        ]);

        $response = $this->post(route('pupil-progression.store'), [
            'student_id' => $this->student->id,
            'source_enrollment_id' => $this->sourceEnrollment->id,
            'action' => 'promote',
            'destination_session_id' => $this->destinationSession->id,
            'destination_section_id' => $this->higherSection->id,
            'note' => 'Preserve academic history test',
        ]);

        $response->assertRedirect(route('pupil-progression.index'));

        // The original result must remain attached to the original enrolment.
        $this->assertDatabaseHas('student_results', [
            'id' => $result->id,
            'enrollment_id' => $this->sourceEnrollment->id,
            'subject_id' => $subject->id,
            'term' => 'First Term',
            'first_assessment' => 17,
            'second_assessment' => 18,
            'exam' => 50,
        ]);

        // The original enrolment is completed, not deleted.
        $this->assertDatabaseHas('enrollments', [
            'id' => $this->sourceEnrollment->id,
            'enrollment_status' => 'completed',
        ]);

        // The pupil receives a new enrolment in the destination session.
        $this->assertDatabaseHas('enrollments', [
            'student_id' => $this->student->id,
            'academic_session_id' => $this->destinationSession->id,
            'section_id' => $this->higherSection->id,
            'promotion_status' => 'promoted',
            'enrollment_status' => 'enrolled',
        ]);

        // The progression audit must also exist.
        $this->assertDatabaseHas('pupil_progression_audits', [
            'student_id' => $this->student->id,
            'source_enrollment_id' => $this->sourceEnrollment->id,
            'action' => 'promote',
            'note' => 'Preserve academic history test',
        ]);
    }

    public function test_progression_does_not_delete_existing_publication_audit_history(): void
    {
        $publicationAudit = \App\Models\ResultPublicationAudit::create([
            'academic_session_id' => $this->sourceSession->id,
            'section_id' => $this->sourceSection->id,
            'term' => 'First Term',
            'action' => 'published',
            'performed_by' => $this->admin->id,
            'eligible_count' => 1,
            'excluded_count' => 0,
            'details' => [
                'test' => 'Existing publication history',
            ],
        ]);

        $response = $this->post(route('pupil-progression.store'), [
            'student_id' => $this->student->id,
            'source_enrollment_id' => $this->sourceEnrollment->id,
            'action' => 'promote',
            'destination_session_id' => $this->destinationSession->id,
            'destination_section_id' => $this->higherSection->id,
        ]);

        $response->assertRedirect(route('pupil-progression.index'));

        $this->assertDatabaseHas('result_publication_audits', [
            'id' => $publicationAudit->id,
            'academic_session_id' => $this->sourceSession->id,
            'section_id' => $this->sourceSection->id,
            'term' => 'First Term',
            'action' => 'published',
            'performed_by' => $this->admin->id,
        ]);

        $this->assertDatabaseCount('result_publication_audits', 1);
    }


}
