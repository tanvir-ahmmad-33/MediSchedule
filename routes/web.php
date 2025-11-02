<?php

use App\Http\Controllers\Doctor\DoctorAppointmentTypeController;
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

    Route::middleware('role:doctor')->group(function () {
        // Dashboard
        Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');

        // Appointment Type
        Route::get   ('/doctor/appointment-type',           [DoctorAppointmentTypeController::class, 'index'])  ->name('doctor.appointment-type.index');
        Route::post  ('/doctor/appointment-type',           [DoctorAppointmentTypeController::class, 'store'])  ->name('doctor.appointment-type.store');
        Route::get   ('/doctor/appointment-type/{id}/edit', [DoctorAppointmentTypeController::class, 'edit'])   ->name('doctor.appointment-type.edit');
        Route::put   ('/doctor/appointment-type/{id}',      [DoctorAppointmentTypeController::class, 'update']) ->name('doctor.appointment-type.update');
        Route::delete('/doctor/appointment-type/{id}',      [DoctorAppointmentTypeController::class, 'destroy'])->name('doctor.appointment-type.destroy');

    });

    Route::middleware('role:staff')->group(function () {
        Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
    });

    Route::middleware('role:patient')->group(function () {
        Route::get('/patient/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');
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


