<?php

use App\Http\Controllers\Doctor\DoctorAppointmentScheduleController;
use App\Http\Controllers\Doctor\DoctorAppointmentTypeController;
use App\Http\Controllers\Doctor\DoctorClinicController;
use App\Http\Controllers\Doctor\DoctorDashboardController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Patient\PatientDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\StaffDashboardController;
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
        Route::get   ('/appointment-type',           [DoctorAppointmentTypeController::class, 'index'])  ->name('doctor.appointment-type.index');
        Route::post  ('/appointment-type',           [DoctorAppointmentTypeController::class, 'store'])  ->name('doctor.appointment-type.store');
        Route::get   ('/appointment-type/{id}/edit', [DoctorAppointmentTypeController::class, 'edit'])   ->name('doctor.appointment-type.edit');
        Route::put   ('/appointment-type/{id}',      [DoctorAppointmentTypeController::class, 'update']) ->name('doctor.appointment-type.update');
        Route::delete('/appointment-type/{id}',      [DoctorAppointmentTypeController::class, 'destroy'])->name('doctor.appointment-type.destroy');

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
        Route::get   ('/appointment-schedule',           [DoctorAppointmentScheduleController::class, 'index'])  ->name('doctor.appointment-schedule.index');
        Route::post  ('/appointment-schedule',           [DoctorAppointmentScheduleController::class, 'store'])  ->name('doctor.appointment-schedule.store');
        Route::get   ('/appointment-schedule/{id}',      [DoctorAppointmentScheduleController::class, 'show'])   ->name('doctor.appointment-schedule.show');
        Route::get   ('/appointment-schedule/{id}/edit', [DoctorAppointmentScheduleController::class, 'edit'])   ->name('doctor.appointment-schedule.edit');
        Route::put   ('/appointment-schedule/{id}',      [DoctorAppointmentScheduleController::class, 'update']) ->name('doctor.appointment-schedule.update');
        Route::delete('/appointment-schedule/{id}',      [DoctorAppointmentScheduleController::class, 'destroy'])->name('doctor.appointment-schedule.destroy');
    });

    // Staff routes
    Route::prefix('staff')->middleware('role:staff')->group(function () {
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
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


