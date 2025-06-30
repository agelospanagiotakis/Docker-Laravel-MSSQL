<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SurgeryController;
use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
// })->middleware(['auth', 'verified'])->name('dashboard.index');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/admissions/{id}', [AdmissionController::class, 'show'])->name('admissions.show');
    });
    Route::get('/patients', [PatientController::class, 'index'])->middleware(['auth', 'verified'])->name('patients.index');
    Route::get('/admissions', [AdmissionController::class, 'index'])->middleware(['auth', 'verified'])->name('admissions.index');
    Route::patch('/admissions/{id}', [AdmissionController::class, 'update'])->middleware(['auth', 'verified'])->name('admissions.update');
    Route::patch('/admissions/texts/{id}', [AdmissionController::class, 'updateTexts'])->middleware(['auth', 'verified'])->name('admissions.texts.update');
    Route::get('/patients/{id}', [PatientController::class, 'show'])->middleware(['auth', 'verified'])->name('patients.show');
    Route::post('/patients/{id}', [PatientController::class, 'update'])->middleware(['auth', 'verified'])->name('patients.update');
    Route::get('/admissions/details/{admissionid}', [PatientController::class, 'getAdmissionDetails']);
   Route::get('/admissions/detailsview/{admissionid}', [AdmissionController::class, 'getDetailsView']);
   Route::get('/admissions/clinicalsview/{admissionid}', [AdmissionController::class, 'getClinicalsView']);
   Route::get('/admissions/surgeriesview/{surgeryid}', [AdmissionController::class, 'getSurgeriesView']);
   Route::get('/admissions/certificatesview/{certificateid}', [AdmissionController::class, 'getCertificatesView']);
   Route::get('/admissions/surgerieslist/{admission}', [AdmissionController::class, 'surgeriesList']);
   Route::get('/admissions/certificateslist/{admission}', [AdmissionController::class, 'certificatesList']);

   Route::get('/surgeries', [SurgeryController::class, 'index'])->name('surgery.index');
   Route::get('/surgeries/{id}', [SurgeryController::class, 'show'])->name('surgery.show');
   Route::patch('/surgeries/{id}', [SurgeryController::class, 'update'])->name('surgeries.update');
   Route::get('/surgeries/pdf/{id}', [SurgeryController::class, 'printPdf'])->name('surgery-details.pdf');
   Route::get('/surgeries/modal/{id}', [SurgeryController::class, 'modalContent'])->name('surgery.modal-content');

   Route::patch('/certificates/{id}', [CertificateController::class, 'update'])->name('certificates.update');

require __DIR__.'/auth.php';
