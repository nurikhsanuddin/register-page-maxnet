<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Models\Billing;
use App\Models\Subscription;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', [DashboardController::class, 'home'])->name('home')->middleware('auth');


// Route::get('/subscriptions', [DashboardController::class, 'subscriptions'])->name('subscriptions')->middleware('auth');
// Route::get('/invoice', [DashboardController::class, 'invoices'])->name('invoices')->middleware('auth');
// Route::get('/invoice/{id}', [DashboardController::class, 'invoice'])->name('invoice')->middleware('auth');

// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/login', [LoginController::class, 'authenticate'])->name('login.action');
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout.action');

// // halaman untuk entry email dan kirim action email
// Route::get('/forgot-password', [LoginController::class, 'forgot'])->name('login.forgot')->middleware('guest');
// Route::post('/forgot-password', [LoginController::class, 'sendemail'])->name('login.sendemail')->middleware('guest');

// // halaman untuk reset password
// Route::get('/reset-password', [LoginController::class, 'reset'])->name('login.reset')->middleware('guest');




// Rute Dashboard (menggunakan middleware 'auth')
// Route::middleware('auth')->group(function () {
//   Route::get('/', [DashboardController::class, 'home'])->name('home');
//   Route::get('/subscriptions', [DashboardController::class, 'subscriptions'])->name('subscriptions');
//   Route::get('/invoice', [DashboardController::class, 'invoices'])->name('invoices');
//   Route::get('/invoice/{id}', [DashboardController::class, 'invoice'])->name('invoice');
//   Route::post('/logout', [LoginController::class, 'logout'])->name('logout.action');

//   Route::get('/password/edit', [DashboardController::class, 'edit'])->name('editPassword');
//   Route::post('/password/update', [DashboardController::class, 'update'])->name('password.update');

//   Route::get('/invoice/show/{invoiceNo}', [DashboardController::class, 'showInv'])->name('show');
//   Route::get('/invoice/download/{invoiceNo}', [DashboardController::class, 'downloadInvoicePDF'])->name('downloadInvoiceCustomer');
//   Route::get('/i/{invoiceNo}', [DashboardController::class, 'invoiceCustomer'])->name('downloadInvoice');
//   Route::get('/checkActive/{id}', [DashboardController::class, 'checkActive'])->name('checkActive');
// });

Route::get('/', [RegistrationController::class, 'index'])->name('index');
// Rute Login (menggunakan middleware 'guest')
Route::middleware('guest')->group(function () {
  // Route::get('/login', [LoginController::class, 'index'])->name('login');
  // Route::post('/login', [LoginController::class, 'authenticate'])->name('login.action');

  Route::get('/registration', action: [RegistrationController::class, 'index'])->name('index');
  Route::get('/registration/register', [RegistrationController::class, 'register'])->name('registration.register');
  Route::post('/registration/register', [RegistrationController::class, 'register_store'])->name('register.store');

  // Route::get('/service', [RegistrationController::class, 'service'])->name('service');
  Route::get('/registration/service', [RegistrationController::class, 'service'])->name('service');
  Route::post('/registration/service', [RegistrationController::class, 'service_store'])->name('service.store');

  Route::get('/registration/profile', [RegistrationController::class, 'profile'])->name('profile');
  Route::post('/registration/profile', [RegistrationController::class, 'profile_store'])->name('profile.store');

  Route::get('/registration/confirmation', [RegistrationController::class, 'confirmation'])->name('confirmation');
  Route::get('/registration/confirmation_store/{register_id}', [RegistrationController::class, 'confirmation_store'])->name('confirmation.store');
  // Halaman untuk reset password
  Route::get('/reset-password', [LoginController::class, 'reset'])->name('login.reset');
});

// Halaman untuk entry email dan kirim action email
Route::get('/forgot-password', [LoginController::class, 'forgot'])->name('login.forgot');
Route::post('/forgot-password', [LoginController::class, 'sendResetLinkEmail'])->name('login.sendemail');
Route::post('reset-password', [LoginController::class, 'resetPassword'])->name('resetPassword');
