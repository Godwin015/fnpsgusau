<?php

namespace Tests\Feature;

use App\Models\AcademicSession;
use App\Models\ClassLevel;
use App\Models\Enrollment;
use App\Models\PupilProgressionAudit;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BatchPupilProgressionTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected AcademicSession $sourceSession;

    protected AcademicSession $destinationSession;

    protected ClassLevel $primaryOne;

    protected ClassLevel $primaryTwo;

    protected ClassLevel $primaryThree;

    protected Section $sourceSection;

    protected Section $sameLevelSection;

    protected Section $higherSection;

    protected Section $lowerSection;

    protected Student $studentOne;

    protected Student $studentTwo;

    protected Student $studentThree;

    protected Enrollment $enrollmentOne;

    protected Enrollment $enrollmentTwo;

    protected Enrollment $enrollmentThree;

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

        $this->studentOne = Student::create([
            'admission_number' => 'FNPS-BATCH-001',
            'first_name' => 'Batch',
            'last_name' => 'Pupil One',
            'status' => 'active',
        ]);

        $this->studentTwo = Student::create([
            'admission_number' => 'FNPS-BATCH-002',
            'first_name' => 'Batch',
            'last_name' => 'Pupil Two',
            'status' => 'active',
        ]);

        $this->studentThree = Student::create([
            'admission_number' => 'FNPS-BATCH-003',
            'first_name' => 'Batch',
            'last_name' => 'Pupil Three',
            'status' => 'active',
        ]);

        $this->enrollmentOne = $this->createSourceEnrollment(
            $this->studentOne
        );

        $this->enrollmentTwo = $this->createSourceEnrollment(
            $this->studentTwo
        );

        $this->enrollmentThree = $this->createSourceEnrollment(
            $this->studentThree
        );
    }

    protected function createSourceEnrollment(
        Student $student
    ): Enrollment {
        return Enrollment::create([
            'student_id' => $student->id,
            'academic_session_id' => $this->sourceSession->id,
            'section_id' => $this->sourceSection->id,
            'promotion_status' => 'pending',
            'enrollment_status' => 'enrolled',
        ]);
    }

    protected function batchPayload(
        string $action = 'promote',
        ?Section $destinationSection = null
    ): array {
        $destinationSection ??= $this->higherSection;

        return [
            'source_session_id' => $this->sourceSession->id,
            'source_section_id' => $this->sourceSection->id,
            'student_ids' => [
                $this->studentOne->id,
                $this->studentTwo->id,
            ],
            'action' => $action,
            'destination_session_id' => (
                $action === 'transfer'
                    ? $this->sourceSession->id
                    : $this->destinationSession->id
            ),
            'destination_section_id' => $destinationSection->id,
            'note' => 'Automated batch progression test',
        ];
    }

    public function test_batch_progression_page_loads(): void
    {
        $response = $this->get(
            route('batch-pupil-progression.index')
        );

        $response->assertOk();
    }

    public function test_batch_promotion_creates_destination_enrollments(): void
    {
        $response = $this->post(
            route('batch-pupil-progression.store'),
            $this->batchPayload('promote')
        );

        $response->assertRedirect(
            route('batch-pupil-progression.index')
        );

        foreach ([
            $this->studentOne,
            $this->studentTwo,
        ] as $student) {
            $this->assertDatabaseHas('enrollments', [
                'student_id' => $student->id,
                'academic_session_id' => $this->destinationSession->id,
                'section_id' => $this->higherSection->id,
                'promotion_status' => 'promoted',
                'enrollment_status' => 'enrolled',
            ]);
        }

        $this->assertDatabaseHas('enrollments', [
            'id' => $this->enrollmentOne->id,
            'promotion_status' => 'promoted',
            'enrollment_status' => 'completed',
        ]);

        $this->assertDatabaseHas('enrollments', [
            'id' => $this->enrollmentTwo->id,
            'promotion_status' => 'promoted',
            'enrollment_status' => 'completed',
        ]);
    }

    public function test_batch_promotion_creates_audit_for_each_pupil(): void
    {
        $response = $this->post(
            route('batch-pupil-progression.store'),
            $this->batchPayload('promote')
        );

        $response->assertRedirect(
            route('batch-pupil-progression.index')
        );

        foreach ([
            $this->studentOne,
            $this->studentTwo,
        ] as $student) {
            $this->assertDatabaseHas(
                'pupil_progression_audits',
                [
                    'student_id' => $student->id,
                    'action' => 'promote',
                    'source_session_id' => $this->sourceSession->id,
                    'destination_session_id' => (
                        $this->destinationSession->id
                    ),
                    'source_section_id' => $this->sourceSection->id,
                    'destination_section_id' => (
                        $this->higherSection->id
                    ),
                    'performed_by' => $this->admin->id,
                ]
            );
        }
    }

    public function test_batch_repeat_creates_new_enrollments(): void
    {
        $payload = $this->batchPayload(
            'repeat',
            $this->sameLevelSection
        );

        $response = $this->post(
            route('batch-pupil-progression.store'),
            $payload
        );

        $response->assertRedirect(
            route('batch-pupil-progression.index')
        );

        foreach ([
            $this->studentOne,
            $this->studentTwo,
        ] as $student) {
            $this->assertDatabaseHas('enrollments', [
                'student_id' => $student->id,
                'academic_session_id' => (
                    $this->destinationSession->id
                ),
                'section_id' => $this->sameLevelSection->id,
                'promotion_status' => 'repeated',
                'enrollment_status' => 'enrolled',
            ]);
        }
    }

    public function test_batch_demote_creates_new_enrollments(): void
    {
        $payload = $this->batchPayload(
            'demote',
            $this->lowerSection
        );

        $response = $this->post(
            route('batch-pupil-progression.store'),
            $payload
        );

        $response->assertRedirect(
            route('batch-pupil-progression.index')
        );

        foreach ([
            $this->studentOne,
            $this->studentTwo,
        ] as $student) {
            $this->assertDatabaseHas('enrollments', [
                'student_id' => $student->id,
                'academic_session_id' => (
                    $this->destinationSession->id
                ),
                'section_id' => $this->lowerSection->id,
                'promotion_status' => 'demoted',
                'enrollment_status' => 'enrolled',
            ]);
        }
    }

    public function test_batch_transfer_updates_existing_enrollments(): void
    {
        $payload = $this->batchPayload(
            'transfer',
            $this->sameLevelSection
        );

        $response = $this->post(
            route('batch-pupil-progression.store'),
            $payload
        );

        $response->assertRedirect(
            route('batch-pupil-progression.index')
        );

        $this->assertDatabaseHas('enrollments', [
            'id' => $this->enrollmentOne->id,
            'section_id' => $this->sameLevelSection->id,
            'enrollment_status' => 'enrolled',
        ]);

        $this->assertDatabaseHas('enrollments', [
            'id' => $this->enrollmentTwo->id,
            'section_id' => $this->sameLevelSection->id,
            'enrollment_status' => 'enrolled',
        ]);

        $this->assertDatabaseCount('enrollments', 3);
    }

    public function test_batch_transfer_creates_audit_for_each_pupil(): void
    {
        $payload = $this->batchPayload(
            'transfer',
            $this->sameLevelSection
        );

        $this->post(
            route('batch-pupil-progression.store'),
            $payload
        );

        foreach ([
            $this->studentOne,
            $this->studentTwo,
        ] as $student) {
            $this->assertDatabaseHas(
                'pupil_progression_audits',
                [
                    'student_id' => $student->id,
                    'action' => 'transfer',
                    'source_enrollment_id' => (
                        $student->id === $this->studentOne->id
                            ? $this->enrollmentOne->id
                            : $this->enrollmentTwo->id
                    ),
                    'destination_enrollment_id' => (
                        $student->id === $this->studentOne->id
                            ? $this->enrollmentOne->id
                            : $this->enrollmentTwo->id
                    ),
                    'performed_by' => $this->admin->id,
                ]
            );
        }
    }

    public function test_batch_rejects_duplicate_student_ids(): void
    {
        $payload = $this->batchPayload();

        $payload['student_ids'] = [
            $this->studentOne->id,
            $this->studentOne->id,
        ];

        $response = $this->from(
            route('batch-pupil-progression.index')
        )->post(
            route('batch-pupil-progression.store'),
            $payload
        );

        $response->assertRedirect(
            route('batch-pupil-progression.index')
        );

        $response->assertSessionHasErrors([
            'student_ids.0',
            'student_ids.1',
        ]);

        $this->assertDatabaseCount('enrollments', 3);

        $this->assertDatabaseCount(
            'pupil_progression_audits',
            0
        );
    }

    public function test_batch_rejects_empty_student_selection(): void
    {
        $payload = $this->batchPayload();

        $payload['student_ids'] = [];

        $response = $this->from(
            route('batch-pupil-progression.index')
        )->post(
            route('batch-pupil-progression.store'),
            $payload
        );

        $response->assertRedirect(
            route('batch-pupil-progression.index')
        );

        $response->assertSessionHasErrors('student_ids');

        $this->assertDatabaseCount('enrollments', 3);

        $this->assertDatabaseCount(
            'pupil_progression_audits',
            0
        );
    }

    public function test_batch_rejects_teacher_access(): void
    {
        $teacher = User::factory()->create([
            'role' => 'teacher',
            'student_id' => null,
            'must_change_password' => false,
        ]);

        $response = $this->actingAs($teacher)->post(
            route('batch-pupil-progression.store'),
            $this->batchPayload()
        );

        $response->assertForbidden();

        $this->assertDatabaseCount('enrollments', 3);

        $this->assertDatabaseCount(
            'pupil_progression_audits',
            0
        );
    }


    public function test_batch_progression_continues_when_one_pupil_fails(): void
    {
        // Pupil 2 already has an enrollment in the destination session.
        // Their progression should fail without affecting the other pupils.
        $existingDestinationEnrollment = Enrollment::create([
            'student_id' => $this->studentTwo->id,
            'academic_session_id' => $this->destinationSession->id,
            'section_id' => $this->higherSection->id,
            'promotion_status' => 'pending',
            'enrollment_status' => 'enrolled',
        ]);

        $response = $this->post(
            route('batch-pupil-progression.store'),
            [
                'source_session_id' => $this->sourceSession->id,
                'source_section_id' => $this->sourceSection->id,
                'student_ids' => [
                    $this->studentOne->id,
                    $this->studentTwo->id,
                    $this->studentThree->id,
                ],
                'action' => 'promote',
                'destination_session_id' => (
                    $this->destinationSession->id
                ),
                'destination_section_id' => (
                    $this->higherSection->id
                ),
                'note' => 'Partial batch failure test',
            ]
        );

        $response->assertRedirect(
            route('batch-pupil-progression.index')
        );

        // Pupil 1 succeeds.
        $this->assertDatabaseHas('enrollments', [
            'student_id' => $this->studentOne->id,
            'academic_session_id' => $this->destinationSession->id,
            'section_id' => $this->higherSection->id,
            'promotion_status' => 'promoted',
            'enrollment_status' => 'enrolled',
        ]);

        // Pupil 3 succeeds even though Pupil 2 failed.
        $this->assertDatabaseHas('enrollments', [
            'student_id' => $this->studentThree->id,
            'academic_session_id' => $this->destinationSession->id,
            'section_id' => $this->higherSection->id,
            'promotion_status' => 'promoted',
            'enrollment_status' => 'enrolled',
        ]);

        // Pupil 2's existing destination enrollment remains unchanged.
        $this->assertDatabaseHas('enrollments', [
            'id' => $existingDestinationEnrollment->id,
            'student_id' => $this->studentTwo->id,
            'academic_session_id' => $this->destinationSession->id,
            'section_id' => $this->higherSection->id,
            'promotion_status' => 'pending',
            'enrollment_status' => 'enrolled',
        ]);

        // Pupil 1's original enrollment is completed.
        $this->assertDatabaseHas('enrollments', [
            'id' => $this->enrollmentOne->id,
            'enrollment_status' => 'completed',
            'promotion_status' => 'promoted',
        ]);

        // Pupil 2's original enrollment remains enrolled.
        $this->assertDatabaseHas('enrollments', [
            'id' => $this->enrollmentTwo->id,
            'enrollment_status' => 'enrolled',
            'promotion_status' => 'pending',
        ]);

        // Pupil 3's original enrollment is completed.
        $this->assertDatabaseHas('enrollments', [
            'id' => $this->enrollmentThree->id,
            'enrollment_status' => 'completed',
            'promotion_status' => 'promoted',
        ]);

        // Only the two successful pupils receive progression audits.
        $this->assertDatabaseCount(
            'pupil_progression_audits',
            2
        );

        $this->assertDatabaseHas('pupil_progression_audits', [
            'student_id' => $this->studentOne->id,
            'action' => 'promote',
            'performed_by' => $this->admin->id,
        ]);

        $this->assertDatabaseHas('pupil_progression_audits', [
            'student_id' => $this->studentThree->id,
            'action' => 'promote',
            'performed_by' => $this->admin->id,
        ]);

        $this->assertDatabaseMissing('pupil_progression_audits', [
            'student_id' => $this->studentTwo->id,
            'action' => 'promote',
        ]);

        // 3 original enrollments + 1 existing destination enrollment
        // + 2 successful destination enrollments.
        $this->assertDatabaseCount('enrollments', 6);
    }

}
