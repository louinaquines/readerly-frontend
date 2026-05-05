<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentReaderController;

// Auth
// Route::get('/', fn() => redirect()->route('login')); // Removed duplicate
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Teacher routes
Route::middleware('api.auth:teacher')->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/classes', [TeacherController::class, 'allClasses'])->name('teacher.classes');
    Route::get('/teacher/class/{classId}', [TeacherController::class, 'showClass'])->name('teacher.class');
    Route::get('/teacher/class/{classId}/student/{studentId}', [TeacherController::class, 'showStudent'])->name('teacher.student');
    Route::post('/teacher/student/{studentId}/assign', [TeacherController::class, 'assignPassage'])->name('teacher.assign');
    Route::post('/teacher/student/{studentId}/session/{sessionId}/approve', [TeacherController::class, 'approveSession'])->name('teacher.approve');
    Route::get('/teacher/class/{classId}/student/{studentId}/export', [TeacherController::class, 'exportPdf'])->name('teacher.export');
    Route::post('/teacher/class/{classId}/students', [TeacherController::class, 'createStudent'])->name('teacher.create-student');
    Route::get('/teacher/reports', [TeacherController::class, 'reports'])->name('teacher.reports');
    Route::get('/teacher/analytics', [TeacherController::class, 'analytics'])->name('teacher.analytics');
    Route::get('/teacher/notifications', [TeacherController::class, 'notifications'])->name('teacher.notifications');
    Route::post('/teacher/classes/store', [TeacherController::class, 'storeClass'])->name('teacher.classes.store');
    Route::get('/teacher/class/{classId}/student/{studentId}/summary', [TeacherController::class, 'generateSummary'])->name('teacher.summary');
});

// Teacher profile — inside auth group
Route::middleware('api.auth:teacher')->group(function () {
    Route::get('/teacher/profile', [TeacherController::class, 'profile'])->name('teacher.profile');
    Route::post('/teacher/profile/update', [TeacherController::class, 'updateProfile'])->name('teacher.profile.update');
    Route::post('/teacher/profile/password', [TeacherController::class, 'updatePassword'])->name('teacher.profile.password');
    Route::post('/teacher/profile/photo', [TeacherController::class, 'updatePhoto'])->name('teacher.profile.photo');
    Route::delete('/teacher/profile/delete', [TeacherController::class, 'deleteAccount'])->name('teacher.profile.delete');
});

// Student profile
Route::middleware('api.auth:student')->group(function () {
    Route::get('/student/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::post('/student/profile/update', [StudentController::class, 'updateProfile'])->name('student.profile.update');
    Route::post('/student/profile/password', [StudentController::class, 'updatePassword'])->name('student.profile.password');
    Route::delete('/student/profile/delete', [StudentController::class, 'deleteAccount'])->name('student.profile.delete');
    Route::post('/student/profile/photo', [StudentController::class, 'updatePhoto'])->name('student.profile.photo');
});

// Student routes
Route::middleware('api.auth:student')->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::post('/student/class/join', [StudentController::class, 'joinClass'])->name('student.join');
});

// Reader (shared)
Route::middleware('api.auth')->group(function () {
    Route::get('/read/{studentId}/{sessionId}', [StudentReaderController::class, 'show'])->name('reader');
});

Route::get('/', fn() => view('welcome'));
