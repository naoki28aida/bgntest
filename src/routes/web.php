<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\AttendanceController;


// トップページ (ダッシュボード)
Route::get('/', [DashboardController::class, 'index'])->name('home')->middleware('auth');

Route::post('/dashboard/work/start', [DashboardController::class, 'startDashboard'])->name('dashboard.workstart');
Route::post('/dashboard/work/end', [DashboardController::class, 'endDashboard'])->name('dashboard.workend');

Route::post('/dashboard/break/start', [DashboardController::class, 'startBreak'])->name('dashboard.breakstart');
Route::post('/dashboard/break/end', [DashboardController::class, 'endBreak'])->name('dashboard.breakend');

// 登録ページ
Auth::routes();
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/thanks', [RegisteredUserController::class, 'thanks'])->name('thanks');

// ログインページ
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/staff', [AttendanceController::class, 'user'])->name('staff.user');

Route::get('/staff/individual/{id}', [AttendanceController::class, 'showIndividual'])->name('staff.individual');


