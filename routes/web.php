<?php

use App\Http\Controllers\Doctor\DoctorAppointmentController;
use App\Http\Controllers\Doctor\DoctorAppointmentScheduleController;
use App\Http\Controllers\Doctor\DoctorAppointmentTypeController;
use App\Http\Controllers\Doctor\DoctorClinicController;
use App\Http\Controllers\Doctor\DoctorDashboardController;
use App\Http\Controllers\Doctor\DoctorPatientController;
use App\Http\Controllers\Doctor\DoctorStaffController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Patient\PatientDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\StaffProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// public routes
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {

    // Doctor routes
    Route::prefix('doctor')->middleware('role:doctor')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');

        // Appointment Type
        Route::get   ('/appointment-type',             [DoctorAppointmentTypeController::class, 'index'])  ->name('doctor.appointment-type.index');
        Route::post  ('/appointment-type',             [DoctorAppointmentTypeController::class, 'store'])  ->name('doctor.appointment-type.store');
        Route::get   ('/appointment-type/{id}',        [DoctorAppointmentTypeController::class, 'show'])   ->name('doctor.appointment-type.show');
        Route::get   ('/appointment-type/{id}/edit',   [DoctorAppointmentTypeController::class, 'edit'])   ->name('doctor.appointment-type.edit');
        Route::put   ('/appointment-type/{id}',        [DoctorAppointmentTypeController::class, 'update']) ->name('doctor.appointment-type.update');
        Route::delete('/appointment-type/{id}',        [DoctorAppointmentTypeController::class, 'destroy'])->name('doctor.appointment-type.destroy');
        Route::put   ('/appointment-type/{id}/status', [DoctorAppointmentTypeController::class, 'updateStatus'])->name('doctor.appointment-type.updateStatus');

        // Clinic
        Route::get   ('/clinic',           [DoctorClinicController::class, 'index'])        ->name('doctor.clinic.index');
        Route::get   ('/clinic/create',    [DoctorClinicController::class, 'create'])       ->name('doctor.clinic.create');
        Route::post  ('/clinic',           [DoctorClinicController::class, 'store'])        ->name('doctor.clinic.store');
        Route::get   ('/clinic/{id}',      [DoctorClinicController::class, 'show'])         ->name('doctor.clinic.show');
        Route::get   ('/clinic/{id}/edit', [DoctorClinicController::class, 'edit'])         ->name('doctor.clinic.edit');
        Route::post  ('/clinic/{id}',      [DoctorClinicController::class, 'update'])       ->name('doctor.clinic.update');
        Route::delete('/clinic/{id}',      [DoctorClinicController::class, 'destroy'])      ->name('doctor.clinic.destroy');
        Route::get   ('/clinics',          [DoctorClinicController::class, 'getAllClinics'])->name('doctor.clinic.getAll');

        // Appointmenment Schedule
        Route::get   ('/appointment-schedule',           [DoctorAppointmentScheduleController::class, 'index'])      ->name('doctor.appointment-schedule.index');
        Route::get   ('/appointment-schedule/create',    [DoctorAppointmentScheduleController::class, 'create'])     ->name('doctor.appointment-schedule.create');
        Route::post  ('/appointment-schedule',           [DoctorAppointmentScheduleController::class, 'store'])      ->name('doctor.appointment-schedule.store');
        Route::get   ('/appointment-schedule/{id}',      [DoctorAppointmentScheduleController::class, 'show'])       ->name('doctor.appointment-schedule.show');
        Route::get   ('/appointment-schedule/{id}/edit', [DoctorAppointmentScheduleController::class, 'edit'])       ->name('doctor.appointment-schedule.edit');
        Route::put   ('/appointment-schedule/{id}',      [DoctorAppointmentScheduleController::class, 'update'])     ->name('doctor.appointment-schedule.update');
        Route::delete('/appointment-schedule/{id}',      [DoctorAppointmentScheduleController::class, 'destroy'])    ->name('doctor.appointment-schedule.destroy');
        Route::get   ('/get-schedule/{id}',              [DoctorAppointmentScheduleController::class, 'getSchedule'])->name('doctor.get-clinic-schedule');

        // Appointmenment
        Route::get ('/appointment',              [DoctorAppointmentController::class, 'index'])         ->name('doctor.appointment.index');
        Route::get ('/appointment/create',       [DoctorAppointmentController::class, 'create'])        ->name('doctor.appointment.create');
        Route::post('/appointment',              [DoctorAppointmentController::class, 'store'])         ->name('doctor.appointment.store');
        Route::get ('/appointment/{id}/patient', [DoctorAppointmentController::class, 'patientDetails'])->name('doctor.appointment.patientDetails');
        Route::put ('/appointment/{id}/status',  [DoctorAppointmentController::class, 'updateStatus'])  ->name('doctor.appointment.updateStatus');
        Route::get ('/appointment/{id}',         [DoctorAppointmentController::class, 'show'])          ->name('doctor.appointment.show');
        Route::get ('/appointments/pending',     [DoctorAppointmentController::class, 'pending'])       ->name('doctor.appointment.pending');
        Route::get ('/appointments/existed',     [DoctorAppointmentController::class, 'existed'])       ->name('doctor.appointment.existed');
        Route::post('/appointments/{id}',        [DoctorAppointmentController::class, 'existedStore'])  ->name('doctor.appointment.existedStore');

        // Patient
        Route::get('/patient',      [DoctorPatientController::class, 'index'])->name('doctor.patient.index');
        Route::get('/patient/{id}', [DoctorPatientController::class, 'show']) ->name('doctor.patient.show');

        // Staff
        Route::get   ('/staff',              [DoctorStaffController::class, 'index'])          ->name('doctor.staff.index');
        Route::get   ('/staff/create',       [DoctorStaffController::class, 'create'])         ->name('doctor.staff.create');
        Route::post  ('/staff',              [DoctorStaffController::class, 'store'])          ->name('doctor.staff.store');
        Route::get   ('/staff/pending',      [DoctorStaffController::class, 'pending'])        ->name('doctor.staff.pending');
        Route::put   ('/staff/{id}/approve', [DoctorStaffController::class, 'approve'])        ->name('doctor.staff.approve');
        Route::get   ('/staff/{id}/edit',    [DoctorStaffController::class, 'edit'])           ->name('doctor.staff.edit');
        Route::post  ('/staff/{id}/status',  [DoctorStaffController::class, 'changeStatus'])   ->name('doctor.staff.changeStatus');
        Route::delete('/staff/{id}',         [DoctorStaffController::class, 'destroy'])        ->name('doctor.staff.destroy');
        Route::delete('/approval/{id}',      [DoctorStaffController::class, 'approvalDestroy'])->name('doctor.approval.destroy');

        
    });

    // Staff routes
    Route::prefix('staff')->middleware('role:staff')->group(function () {
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');

        Route::get('/profile', [StaffProfileController::class, 'index'])->name('staff.profile.index');
    });

    // Patient routes
    Route::prefix('patient')->middleware('role:patient')->group(function () {
        Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');
    });
});



require __DIR__.'/auth.php';



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


