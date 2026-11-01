<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\PupilProgressionAudit;
use App\Models\PupilProgressionCorrection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PupilProgressionCorrectionController extends Controller
{
    /**
     * Display progression audits available for correction.
     */
    
    public function index()
    {
        $audits = PupilProgressionAudit::with([
            'student',
            'sourceEnrollment',
            'destinationEnrollment',
            'performedBy',

            // Historical sections saved in the progression audit.
            'sourceSection.classLevel',
            'destinationSection.classLevel',
        ])
            ->whereDoesntHave('correction')
            ->latest()
            ->paginate(20);

        return view(
            'super-admin.pupil-progression-corrections.index',
            compact('audits')
        );
    }

    /**
     * Reverse an existing pupil progression.
     */
    public function reverse(Request $request, PupilProgressionAudit $audit)
    {
        $validated = $request->validate([
            'reason' => [
                'required',
                'string',
                'min:10',
                'max:2000',
            ],
        ]);

        DB::transaction(function () use ($audit, $validated, $request) {

            $audit = PupilProgressionAudit::whereKey($audit->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Prevent correcting the same audit twice.
            $alreadyCorrected = PupilProgressionCorrection::where(
                'pupil_progression_audit_id',
                $audit->id
            )->exists();

            if ($alreadyCorrected) {
                throw ValidationException::withMessages([
                    'reason' => 'This progression has already been corrected.',
                ]);
            }

            // Lock the affected pupil.
            DB::table('students')
                ->where('id', $audit->student_id)
                ->lockForUpdate()
                ->first();

            if (!$audit->source_enrollment_id) {
                throw ValidationException::withMessages([
                    'reason' => 'The original source enrollment is missing.',
                ]);
            }

            $source = Enrollment::whereKey(
                $audit->source_enrollment_id
            )
                ->lockForUpdate()
                ->first();

            if (!$source) {
                throw ValidationException::withMessages([
                    'reason' => 'The original source enrollment no longer exists.',
                ]);
            }

            if ($source->student_id != $audit->student_id) {
                throw ValidationException::withMessages([
                    'reason' => 'The source enrollment does not belong to this pupil.',
                ]);
            }

            // Preserve the original enrollment details.
            $beforeSnapshot = [
                'source_enrollment' => $source->only([
                    'id',
                    'student_id',
                    'academic_session_id',
                    'section_id',
                    'promotion_status',
                    'enrollment_status',
                ]),
                'audit' => [
                    'id' => $audit->id,
                    'action' => $audit->action,
                    'source_session_id' => $audit->source_session_id,
                    'destination_session_id' => $audit->destination_session_id,
                    'source_section_id' => $audit->source_section_id,
                    'destination_section_id' => $audit->destination_section_id,
                ],
            ];

            /*
             * TRANSFER REVERSAL
             */
            if ($audit->action === 'transfer') {

                if (
                    $audit->source_section_id === null ||
                    $audit->destination_section_id === null
                ) {
                    throw ValidationException::withMessages([
                        'reason' => 'The original transfer section information is incomplete.',
                    ]);
                }

                if (
                    $source->academic_session_id != $audit->source_session_id ||
                    $source->section_id != $audit->destination_section_id
                ) {
                    throw ValidationException::withMessages([
                        'reason' => 'The pupil enrollment has changed since the original transfer.',
                    ]);
                }

                // Do not reverse a transfer if results have been recorded.
                if ($source->studentResults()->exists()) {
                    throw ValidationException::withMessages([
                        'reason' => 'This transfer cannot be reversed because results exist for the enrollment.',
                    ]);
                }

                // Ensure the transfer has not been followed by another progression.
                $laterProgression = PupilProgressionAudit::where(
                    'student_id',
                    $audit->student_id
                )
                    ->where('id', '>', $audit->id)
                    ->exists();

                if ($laterProgression) {
                    throw ValidationException::withMessages([
                        'reason' => 'A later progression audit exists. Review the pupil history before reversing this transfer.',
                    ]);
                }

                // Restore the original section.
                $source->section_id = $audit->source_section_id;
                $source->save();

                $correctionType = 'transfer_reversal';
            }

            /*
             * PROMOTION / REPETITION / DEMOTION REVERSAL
             */
            else {

                if (!$audit->destination_enrollment_id) {
                    throw ValidationException::withMessages([
                        'reason' => 'The destination enrollment is missing.',
                    ]);
                }

                $destination = Enrollment::whereKey(
                    $audit->destination_enrollment_id
                )
                    ->lockForUpdate()
                    ->first();

                if (!$destination) {
                    throw ValidationException::withMessages([
                        'reason' => 'The destination enrollment no longer exists.',
                    ]);
                }

                if ($destination->student_id != $audit->student_id) {
                    throw ValidationException::withMessages([
                        'reason' => 'The destination enrollment does not belong to this pupil.',
                    ]);
                }

                if (
                    $destination->academic_session_id !=
                    $audit->destination_session_id
                ) {
                    throw ValidationException::withMessages([
                        'reason' => 'The destination enrollment session does not match the original progression.',
                    ]);
                }

                if (
                    $destination->section_id !=
                    $audit->destination_section_id
                ) {
                    throw ValidationException::withMessages([
                        'reason' => 'The destination enrollment section has changed.',
                    ]);
                }

                if ($destination->enrollment_status !== 'enrolled') {
                    throw ValidationException::withMessages([
                        'reason' => 'The destination enrollment is no longer active.',
                    ]);
                }

                if ($source->enrollment_status !== 'completed') {
                    throw ValidationException::withMessages([
                        'reason' => 'The source enrollment is not in its expected completed state.',
                    ]);
                }

                if (
                    $source->academic_session_id !=
                    $audit->source_session_id
                ) {
                    throw ValidationException::withMessages([
                        'reason' => 'The source enrollment session does not match the original progression.',
                    ]);
                }

                // Do not reverse when results have been entered in the
                // destination enrollment.
                if ($destination->studentResults()->exists()) {
                    throw ValidationException::withMessages([
                        'reason' => 'This progression cannot be reversed because destination results exist.',
                    ]);
                }

                // Do not reverse when destination fee records exist.
                if (
                    $destination->feeStatuses()->exists() ||
                    $destination->feeStatusAudits()->exists()
                ) {
                    throw ValidationException::withMessages([
                        'reason' => 'This progression cannot be reversed because destination fee records or fee history exist.',
                    ]);
                }

                // Protect later progression history.
                $laterProgression = PupilProgressionAudit::where(
                    'student_id',
                    $audit->student_id
                )
                    ->where('id', '>', $audit->id)
                    ->exists();

                if ($laterProgression) {
                    throw ValidationException::withMessages([
                        'reason' => 'A later progression audit exists. Review the pupil history before reversing this progression.',
                    ]);
                }

                // Protect other enrollments created after the destination.
                $otherEnrollment = Enrollment::where(
                    'student_id',
                    $audit->student_id
                )
                    ->whereNotIn('id', [
                        $source->id,
                        $destination->id,
                    ])
                    ->exists();

                if ($otherEnrollment) {
                    throw ValidationException::withMessages([
                        'reason' => 'Another enrollment exists for this pupil. Review the enrollment history before reversing.',
                    ]);
                }

                // Save destination before-state.
                $beforeSnapshot['destination_enrollment'] =
                    $destination->only([
                        'id',
                        'student_id',
                        'academic_session_id',
                        'section_id',
                        'promotion_status',
                        'enrollment_status',
                    ]);

                // Cancel the destination enrollment.
                // We preserve the enrollment record instead of deleting it.
                $destination->enrollment_status = 'cancelled';
                $destination->promotion_status = 'reversed';
                $destination->save();

                // Restore the source enrollment as active.
                $source->enrollment_status = 'enrolled';
                $source->promotion_status = 'reversed';
                $source->save();

                $correctionType = 'progression_reversal';
            }

            // Preserve the final enrollment state.
            $afterSnapshot = [
                'source_enrollment' => $source->fresh()->only([
                    'id',
                    'student_id',
                    'academic_session_id',
                    'section_id',
                    'promotion_status',
                    'enrollment_status',
                ]),
            ];

            if (isset($destination)) {
                $afterSnapshot['destination_enrollment'] =
                    $destination->fresh()->only([
                        'id',
                        'student_id',
                        'academic_session_id',
                        'section_id',
                        'promotion_status',
                        'enrollment_status',
                    ]);
            }

            // Record the correction permanently.
            PupilProgressionCorrection::create([
                'pupil_progression_audit_id' => $audit->id,
                'student_id' => $audit->student_id,
                'performed_by' => $request->user()->id,
                'correction_type' => $correctionType,
                'reason' => $validated['reason'],
                'before_snapshot' => $beforeSnapshot,
                'after_snapshot' => $afterSnapshot,
            ]);
        });

        return redirect()
            ->route('pupil-progression-corrections.index')
            ->with(
                'success',
                'The pupil progression has been corrected successfully.'
            );
    }
}
