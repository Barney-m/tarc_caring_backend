<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminControllers\AdminHomeController;
use App\Http\Controllers\AdminControllers\Auth\AdminLoginController;
use App\Http\Controllers\AdminControllers\Auth\AdminConfirmPasswordController;
use App\Http\Controllers\AdminControllers\Auth\AdminResetPasswordController;
use App\Http\Controllers\AdminControllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\AdminControllers\Auth\AdminRegisterController;
use App\Http\Controllers\AdminControllers\Auth\AdminVerificationController;

use App\Http\Controllers\UserControllers\Auth\LoginController;
use App\Http\Controllers\UserControllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\UserControllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserControllers\Auth\ForgotPasswordController;
use App\Http\Controllers\UserControllers\Auth\RegisterController;
use App\Http\Controllers\UserControllers\Auth\VerificationController;
use App\Http\Controllers\UserControllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/home', [AdminHomeController::class, 'adminHome'])->name('admin.test')->middleware('privilege');

// Route::get('/home', [App\Http\Controllers\UserControllers\HomeController::class, 'index'])->name('user.home');
Route::redirect('/login', '/user/home');
Route::redirect('/home', '/user/home');
Route::redirect('/user', '/user/home');
Route::prefix('/user')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('user.home');

    //User Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('/login', [LoginController::class, 'login'])->name('user.login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

    //Password Confirmation
    Route::get('/password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('user.password.confirm');
    Route::post('/password/confirm', [ConfirmPasswordController::class, 'confirm']);

    //Password Reset
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('user.password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('user.password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('user.password.update');

    //Registration
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('/register', [RegisterController::class, 'register']);

    //Email Verification
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('user.verification.notice');
    Route::get('/email/verify/{id}/{token}', [VerificationController::class, 'verify'])->name('user.verification.verify');
    Route::post('/password/confirm', [VerificationController::class, 'resend'])->name('user.verification.resend');
});

Route::redirect('/admin', '/admin/home');
Route::prefix('/admin')->group(function(){
    Route::get('/home', [AdminHomeController::class, 'index'])->name('admin.home');

    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    //Password Confirmation
    Route::get('/password/confirm', [AdminConfirmPasswordController::class, 'showConfirmForm'])->name('admin.password.confirm');
    Route::post('/password/confirm', [AdminConfirmPasswordController::class, 'confirm']);

    //Password Reset
    Route::get('/password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('/password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [AdminResetPasswordController::class, 'reset'])->name('admin.password.update');

    //Registration
    Route::get('/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [AdminRegisterController::class, 'register']);

    //Email Verification
    Route::get('/email/verify', [AdminVerificationController::class, 'show'])->name('admin.verification.notice');
    Route::get('/email/verify/{id}/{token}', [AdminVerificationController::class, 'verify'])->name('admin.verification.verify');
    Route::post('/password/confirm', [AdminVerificationController::class, 'resend'])->name('admin.verification.resend');
});
