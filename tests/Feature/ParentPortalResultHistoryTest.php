<?php

namespace Tests\Feature;

use App\Models\AcademicSession;
use App\Models\ClassLevel;
use App\Models\ClassTermPublication;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentFeeStatus;
use App\Models\StudentResult;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParentPortalResultHistoryTest extends TestCase
{
    use RefreshDatabase;

    protected User $parentUser;

    protected Student $student;

    protected AcademicSession $session;

    protected ClassLevel $classLevel;

    protected Section $section;

    protected Enrollment $enrollment;

    protected Subject $subject;

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

        $this->student = Student::create([
            'admission_number' => 'FNPS-PORTAL-001',
            'first_name' => 'Portal',
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

        $this->subject = Subject::create([
            'name' => 'Mathematics',
            'code' => 'PORTAL-MATH',
            'is_active' => true,
        ]);

        $this->classLevel->subjects()->attach($this->subject->id);

        $this->parentUser = User::factory()->create([
            'role' => 'student',
            'student_id' => $this->student->id,
            'login_id' => $this->student->admission_number,
            'must_change_pin' => false,
        ]);
    }

    protected function preparePublishedResult(): StudentResult
    {
        StudentFeeStatus::create([
            'enrollment_id' => $this->enrollment->id,
            'term' => 'First Term',
            'status' => StudentFeeStatus::PAID,
        ]);

        ClassTermPublication::create([
            'academic_session_id' => $this->session->id,
            'section_id' => $this->section->id,
            'term' => 'First Term',
            'is_published' => true,
            'published_by' => null,
            'published_at' => now(),
        ]);

        return StudentResult::create([
            'enrollment_id' => $this->enrollment->id,
            'subject_id' => $this->subject->id,
            'term' => 'First Term',
            'first_assessment' => 18,
            'second_assessment' => 19,
            'exam' => 55,
            'entered_by' => null,
            'status' => 'submitted',
            'published_at' => now(),
        ]);
    }

    public function test_pupil_can_download_old_published_result(): void
    {
        $result = $this->preparePublishedResult();

        $response = $this->actingAs($this->parentUser)
            ->get(route('parent.results.pdf', [
                'session_id' => $this->session->id,
                'term' => 'First Term',
            ]));

        $response->assertOk();

        $response->assertHeader('content-type', 'application/pdf');

        $this->assertDatabaseHas('student_results', [
            'id' => $result->id,
            'enrollment_id' => $this->enrollment->id,
            'first_assessment' => 18,
            'second_assessment' => 19,
            'exam' => 55,
        ]);
    }

    public function test_pupil_cannot_download_results_for_session_without_enrollment(): void
    {
        $anotherSession = AcademicSession::create([
            'name' => '2027/2028',
            'start_date' => '2027-09-01',
            'end_date' => '2028-07-31',
            'is_current' => false,
        ]);

        $response = $this->actingAs($this->parentUser)
            ->get(route('parent.results.pdf', [
                'session_id' => $anotherSession->id,
                'term' => 'First Term',
            ]));

        $response->assertNotFound();
    }

    public function test_unpublished_result_is_not_downloadable(): void
    {
        $this->preparePublishedResult();

        ClassTermPublication::query()
            ->where('academic_session_id', $this->session->id)
            ->where('section_id', $this->section->id)
            ->where('term', 'First Term')
            ->update([
                'is_published' => false,
            ]);

        $response = $this->actingAs($this->parentUser)
            ->get(route('parent.results.pdf', [
                'session_id' => $this->session->id,
                'term' => 'First Term',
            ]));

        $response->assertRedirect(route('parent.dashboard'));

        $response->assertSessionHas('error');
    }

    public function test_pupil_cannot_download_another_pupils_result(): void
    {
        $this->preparePublishedResult();

        $anotherStudent = Student::create([
            'admission_number' => 'FNPS-PORTAL-002',
            'first_name' => 'Another',
            'last_name' => 'Pupil',
            'status' => 'active',
        ]);

        $anotherUser = User::factory()->create([
            'role' => 'student',
            'student_id' => $anotherStudent->id,
            'login_id' => $anotherStudent->admission_number,
            'must_change_pin' => false,
        ]);

        $response = $this->actingAs($anotherUser)
            ->get(route('parent.results.pdf', [
                'session_id' => $this->session->id,
                'term' => 'First Term',
            ]));

        $response->assertNotFound();
    }


    public function test_pupil_can_download_old_result_after_promotion(): void
    {
        $result = $this->preparePublishedResult();

        // Create the next academic session.
        $nextSession = AcademicSession::create([
            'name' => '2026/2027',
            'start_date' => '2026-09-01',
            'end_date' => '2027-07-31',
            'is_current' => false,
        ]);

        // Create the destination class and section.
        $nextClassLevel = ClassLevel::create([
            'name' => 'Primary 3',
            'code' => 'P3',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        $nextSection = Section::create([
            'class_level_id' => $nextClassLevel->id,
            'name' => 'Green',
            'is_active' => true,
        ]);

        // Simulate the completed old enrolment after promotion.
        $this->enrollment->update([
            'promotion_status' => 'promoted',
            'enrollment_status' => 'completed',
        ]);

        // Create the pupil's new enrolment.
        Enrollment::create([
            'student_id' => $this->student->id,
            'academic_session_id' => $nextSession->id,
            'section_id' => $nextSection->id,
            'promotion_status' => 'promoted',
            'enrollment_status' => 'enrolled',
        ]);

        // The pupil requests the old session's result.
        $response = $this->actingAs($this->parentUser)
            ->get(route('parent.results.pdf', [
                'session_id' => $this->session->id,
                'term' => 'First Term',
            ]));

        $response->assertOk();
        $response->assertHeader('content-type', 'application/pdf');

        // Confirm the original result was not moved or deleted.
        $this->assertDatabaseHas('student_results', [
            'id' => $result->id,
            'enrollment_id' => $this->enrollment->id,
            'term' => 'First Term',
            'first_assessment' => 18,
            'second_assessment' => 19,
            'exam' => 55,
        ]);

        // Confirm the old enrolment remains completed.
        $this->assertDatabaseHas('enrollments', [
            'id' => $this->enrollment->id,
            'enrollment_status' => 'completed',
        ]);

        // Confirm the new enrolment exists.
        $this->assertDatabaseHas('enrollments', [
            'student_id' => $this->student->id,
            'academic_session_id' => $nextSession->id,
            'section_id' => $nextSection->id,
            'enrollment_status' => 'enrolled',
        ]);
    }


    public function test_pupil_cannot_download_published_result_after_fee_changes_to_not_paid(): void
    {
        // Prepare a complete result that is published and initially Paid.
        $result = $this->preparePublishedResult();

        $originalPublishedAt = $result->published_at;

        // Change the pupil's fee status to Not Paid.
        StudentFeeStatus::where('enrollment_id', $this->enrollment->id)
            ->where('term', 'First Term')
            ->update([
                'status' => StudentFeeStatus::NOT_PAID,
            ]);

        // The pupil attempts to download the result.
        $response = $this->actingAs($this->parentUser)
            ->get(route('parent.results.pdf', [
                'session_id' => $this->session->id,
                'term' => 'First Term',
            ]));

        // The portal must block access because the current fee status is Not Paid.
        $response->assertRedirect(route('parent.dashboard'));
        $response->assertSessionHas('error');

        // The score must remain preserved.
        $this->assertDatabaseHas('student_results', [
            'id' => $result->id,
            'enrollment_id' => $this->enrollment->id,
            'first_assessment' => 18,
            'second_assessment' => 19,
            'exam' => 55,
        ]);

        // Fee changes must not erase the original publication timestamp.
        $this->assertEquals(
            $originalPublishedAt->toDateTimeString(),
            $result->fresh()->published_at->toDateTimeString()
        );

        // The class-term publication itself remains published.
        $this->assertDatabaseHas('class_term_publications', [
            'academic_session_id' => $this->session->id,
            'section_id' => $this->section->id,
            'term' => 'First Term',
            'is_published' => true,
        ]);
    }


}
