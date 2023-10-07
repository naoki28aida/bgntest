<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;

// トップページ (ダッシュボード)
Route::get('/', [DashboardController::class, 'index'])->name('home')->middleware('auth');

// 登録ページ
Auth::routes();
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// ログインページ
Route::get('/login', [AuthenticatedSessionController::class, 'index'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::post('/attendance/work/start', [DashboardController::class, 'startAttendance'])->name('attendance.workstart');
Route::post('/attendance/work/end', [DashboardController::class, 'endAttendance'])->name('attendance.workend');

Route::post('/attendance/break/start', [DashboardController::class, 'startBreak'])->name('attendance.breakstart');
Route::post('/attendance/break/end', [DashboardController::class, 'endBreak'])->name('attendance.breakend');
