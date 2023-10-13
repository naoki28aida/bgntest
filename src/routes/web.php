<?php

use App\Models\User;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ResendEmailController;

Auth::routes(['verify' => true]);

// ログインしているとアクセス不可
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::get('/thanks', [RegisteredUserController::class, 'thanks'])->name('thanks');
    Route::get('/success', [RegisteredUserController::class, 'success'])->name('success');
    Route::view('/login', 'auth.login')->name('login');
});

// ログインしている場合のみアクセス可能
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::post('/dashboard/work/start', [DashboardController::class, 'startDashboard'])->name('dashboard.workstart');
    Route::post('/dashboard/work/end', [DashboardController::class, 'endDashboard'])->name('dashboard.workend');
    Route::post('/dashboard/break/start', [DashboardController::class, 'startBreak'])->name('dashboard.breakstart');
    Route::post('/dashboard/break/end', [DashboardController::class, 'endBreak'])->name('dashboard.breakend');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/staff', [AttendanceController::class, 'user'])->name('staff.user');
    Route::get('/staff/individual/{id}', [AttendanceController::class, 'showIndividual'])->name('staff.individual');
});

Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::find($id);
    $user->email_verified_at = now();
    $user->save();
    return redirect('/success')->with('status', 'メールが確認されました。ログインしてください。');
})->name('verification.verify');

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/email/resend', [ResendEmailController::class, 'resend'])->name('verification.resend');
