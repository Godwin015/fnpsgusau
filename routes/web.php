<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentPortalController;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\StaffPasswordController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ScoreEntryController;
use App\Http\Controllers\ResultPublicationController;
use App\Http\Controllers\ResultViewingController;
use App\Http\Controllers\StudentFeeStatusController;
use App\Http\Controllers\ClassTermResultPublicationController;
use App\Http\Controllers\ResultPublicationAuditController;
use App\Http\Controllers\PupilProgressionController;
use App\Http\Controllers\PupilProgressionAuditController;
use App\Http\Controllers\BatchPupilProgressionController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Pupil portal login
|--------------------------------------------------------------------------
*/

Route::get('/parent/login', [ParentPortalController::class, 'showLogin'])
    ->name('parent.login');

Route::post('/parent/login', [ParentPortalController::class, 'login'])
    ->name('parent.login.submit');

Route::middleware(['auth', 'pin.changed'])->prefix('parent')->group(function () {
    Route::get('/change-pin', [ParentPortalController::class, 'editPin'])
        ->name('parent.pin.edit');

    Route::post('/change-pin', [ParentPortalController::class, 'updatePin'])
        ->name('parent.pin.update');

    Route::get('/dashboard', [ParentPortalController::class, 'dashboard'])
        ->name('parent.dashboard');

    Route::post('/logout', [ParentPortalController::class, 'logout'])
        ->name('parent.logout');

    Route::get('/results/pdf', [
        ParentPortalController::class,
        'downloadResultsPdf',
    ])->name('parent.results.pdf');
});

/*
|--------------------------------------------------------------------------
| Staff login
|--------------------------------------------------------------------------
*/

Route::get('/staff/login', [StaffAuthController::class, 'showLogin'])
    ->name('staff.login');

Route::post('/staff/login', [StaffAuthController::class, 'login'])
    ->name('staff.login.submit');

/*
|--------------------------------------------------------------------------
| Authenticated staff dashboard
|--------------------------------------------------------------------------
*/


Route::middleware(['auth', 'staff'])->prefix('staff')->group(function () {
    Route::get('/change-password', [StaffPasswordController::class, 'edit'])
        ->name('staff.password.edit');

    Route::post('/change-password', [StaffPasswordController::class, 'update'])
        ->name('staff.password.update');

    Route::post('/logout', [StaffAuthController::class, 'logout'])
        ->name('staff.logout');

    Route::middleware('staff.password.changed')->group(function () {
        Route::get('/dashboard', [StaffAuthController::class, 'dashboard'])
            ->name('staff.dashboard');
    });


    Route::get('/results/entry', [ScoreEntryController::class, 'index'])
        ->name('results.entry');

    Route::post('/results/entry', [ScoreEntryController::class, 'store'])
        ->name('results.store');

    
    Route::get('/results', [ResultViewingController::class, 'classes'])
        ->name('results.classes');

    Route::get('/results/classes/{section}', [
        ResultViewingController::class,
        'students',
    ])->name('results.students');

    Route::get('/results/pupils/{student}', [
        ResultViewingController::class,
        'studentResults',
    ])->name('results.student');


    Route::get('/results/pupils/{student}/pdf', [
        ResultViewingController::class,
        'downloadStudentResults',
    ])->name('results.student.pdf');

});



Route::middleware(['auth', 'staff', 'super_admin', 'staff.password.changed'])
    ->prefix('staff-management')
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\StaffManagementController::class, 'index'])
            ->name('staff-management.index');

        Route::post('/', [\App\Http\Controllers\StaffManagementController::class, 'store'])
            ->name('staff-management.store');

        Route::put('/{user}/assignments', [
            \App\Http\Controllers\StaffManagementController::class,
            'updateAssignments',
        ])->name('staff-management.assignments.update');

        Route::get('/subjects', [SubjectController::class, 'index'])
            ->name('subjects.index');

        Route::post('/subjects', [SubjectController::class, 'store'])
            ->name('subjects.store');

        Route::put('/subjects/{subject}', [SubjectController::class, 'update'])
            ->name('subjects.update');

        Route::post('/results/{result}/publish', [
            ResultPublicationController::class,
            'publish',
        ])->name('results.publish');

        Route::post('/results/{result}/unpublish', [
            ResultPublicationController::class,
            'unpublish',
        ])->name('results.unpublish');

        Route::get('/fee-statuses', [
            StudentFeeStatusController::class,
            'index',
        ])->name('staff-management.fee-statuses');

        Route::post('/fee-statuses/{enrollment}', [
            StudentFeeStatusController::class,
            'update',
        ])->name('staff-management.fee-statuses.update');

        Route::get('/class-term-publication', [
            ClassTermResultPublicationController::class,
            'index',
        ])->name('staff-management.class-term-publication');

        Route::post('/class-term-publication/publish', [
            ClassTermResultPublicationController::class,
            'publish',
        ])->name('staff-management.class-term-publication.publish');

        Route::post('/class-term-publication/unpublish', [
            ClassTermResultPublicationController::class,
            'unpublish',
        ])->name('staff-management.class-term-publication.unpublish');

        Route::get('/publication-audits', [
            ResultPublicationAuditController::class,
            'index',
        ])->name('staff-management.publication-audits');

        Route::post('/{user}/reset-password', [
            \App\Http\Controllers\StaffManagementController::class,
            'resetPassword',
        ])->name('staff-management.password.reset');

        Route::get('/pupil-pin-resets', [
            \App\Http\Controllers\StudentPinResetController::class,
            'index',
        ])->name('staff-management.pupil-pin-resets');

        Route::post('/pupil-pin-resets/{student}', [
            \App\Http\Controllers\StudentPinResetController::class,
            'reset',
        ])->name('staff-management.pupil-pin-resets.reset');

        Route::get('/pupil-progression/audits', [
            PupilProgressionAuditController::class,
            'index',
        ])->name('pupil-progression.audits');
    });

/*
|--------------------------------------------------------------------------
| School management — staff only
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'staff', 'super_admin', 'staff.password.changed'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])
        ->name('students.index');

    Route::post('/students', [StudentController::class, 'store'])
        ->name('students.store');

    Route::get('/academic-sessions', [AcademicSessionController::class, 'index'])
        ->name('academic-sessions.index');

    Route::post('/academic-sessions', [AcademicSessionController::class, 'store'])
        ->name('academic-sessions.store');

    Route::put('/academic-sessions/{academicSession}', [AcademicSessionController::class, 'update'])
        ->name('academic-sessions.update');

    Route::delete('/academic-sessions/{academicSession}', [AcademicSessionController::class, 'destroy'])
        ->name('academic-sessions.destroy');

    Route::get('/pupil-progression', [
        PupilProgressionController::class,
        'index',
    ])->name('pupil-progression.index');

    Route::post('/pupil-progression', [
        PupilProgressionController::class,
        'store',
    ])->name('pupil-progression.store');

    Route::get('/batch-pupil-progression', [
        BatchPupilProgressionController::class,
        'index',
    ])->name('batch-pupil-progression.index');

    Route::get('/batch-pupil-progression/pupils', [
        BatchPupilProgressionController::class,
        'pupils',
    ])->name('batch-pupil-progression.pupils');

    Route::post('/batch-pupil-progression', [
        BatchPupilProgressionController::class,
        'store',
    ])->name('batch-pupil-progression.store');

});
