<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Tutor\AvailabilityController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', function () {
    return view('landing');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tutor-catalog', [App\Http\Controllers\Student\TutorCatalogController::class, 'index'])->name('tutor-catalog.index');
    Route::get('/tutor-catalog/{availability}/booking', [App\Http\Controllers\Student\TutorCatalogController::class, 'showBookingForm'])->name('tutor-catalog.booking');
    Route::post('/tutor-catalog/{availability}/booking', [App\Http\Controllers\Student\TutorCatalogController::class, 'storeBooking'])->name('tutor-catalog.store-booking');

    // Payment routes
    Route::get('/payments', [App\Http\Controllers\Student\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [App\Http\Controllers\Student\PaymentController::class, 'show'])->name('payments.show');
    Route::get('/payments/{payment}/edit', [App\Http\Controllers\Student\PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('/payments/{payment}', [App\Http\Controllers\Student\PaymentController::class, 'update'])->name('payments.update');
});

Route::middleware(['auth', 'role:tutor'])->prefix('tutor')->name('tutor.')->group(function () {
    Route::get('/dashboard', [TutorDashboardController::class, 'index'])->name('dashboard');
    Route::resource('availabilities', AvailabilityController::class);

    // Session management routes
    Route::get('/sessions', [App\Http\Controllers\Tutor\SessionController::class, 'index'])->name('sessions.index');
    Route::get('/sessions/{session}', [App\Http\Controllers\Tutor\SessionController::class, 'show'])->name('sessions.show');
    Route::put('/sessions/{session}/payment-status', [App\Http\Controllers\Tutor\SessionController::class, 'updatePaymentStatus'])->name('sessions.update-payment-status');
    Route::put('/sessions/{session}/session-status', [App\Http\Controllers\Tutor\SessionController::class, 'updateSessionStatus'])->name('sessions.update-session-status');
    Route::put('/sessions/{session}/meeting-link', [App\Http\Controllers\Tutor\SessionController::class, 'updateMeetingLink'])->name('sessions.update-meeting-link');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/account/settings', [AccountSettingsController::class, 'index'])->name('account.settings');
    Route::put('/account/settings', [AccountSettingsController::class, 'updateProfile'])->name('account.settings.update');
});
