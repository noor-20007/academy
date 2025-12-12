<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RegistrationRequestController;
use App\Http\Controllers\Admin\RegistrationRequestController as AdminRegistrationRequestController;

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// Public pages: home, courses, categories
Route::get('/', [HomeController::class, 'index']);
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/courses/{id}/roadmap', [\App\Http\Controllers\CourseController::class, 'roadmap'])->name('courses.roadmap');

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}/courses', [CategoryController::class, 'courses']);

// Registration requests
Route::get('/register-request', [RegistrationRequestController::class, 'create'])->name('registration.create');
Route::post('/register-request', [RegistrationRequestController::class, 'store'])->name('registration.store');

// Lesson viewing (protected)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/lessons/{id}', [LessonController::class, 'show'])->name('lessons.show');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Enrollment
    Route::post('/enroll', [EnrollmentController::class, 'store']);

    // Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index']);

    // Tasks
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks/{id}/submit', [TaskController::class, 'submit']);
});

// Teacher
Route::middleware(['auth'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Teacher\DashboardController::class, 'index']);
    Route::get('/lessons', [\App\Http\Controllers\Teacher\LessonController::class, 'index']);
    Route::get('/lessons/create', [\App\Http\Controllers\Teacher\LessonController::class, 'create']);
    Route::post('/lessons', [\App\Http\Controllers\Teacher\LessonController::class, 'store']);
    Route::get('/tasks', [\App\Http\Controllers\Teacher\TaskController::class, 'index']);
    Route::get('/tasks/create', [\App\Http\Controllers\Teacher\TaskController::class, 'create']);
    Route::post('/tasks', [\App\Http\Controllers\Teacher\TaskController::class, 'store']);
    Route::get('/tasks/{id}/submissions', [\App\Http\Controllers\Teacher\TaskController::class, 'submissions']);
    Route::post('/tasks/submissions/{id}/feedback', [\App\Http\Controllers\Teacher\TaskController::class, 'feedback']);
    Route::get('/attendance/{id}', [\App\Http\Controllers\Teacher\AttendanceController::class, 'show']);
    Route::post('/attendance/{id}', [\App\Http\Controllers\Teacher\AttendanceController::class, 'update']);
});

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::post('users/{user}/approve', [UserController::class, 'approve']);
    Route::post('users/{user}/reject', [UserController::class, 'reject']);
    Route::resource('courses', AdminCourseController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('lessons', AdminLessonController::class);
    Route::resource('tasks', AdminTaskController::class);
    Route::get('tasks/{id}/submissions', [AdminTaskController::class, 'submissions']);
    Route::post('tasks/submissions/{id}/feedback', [AdminTaskController::class, 'feedback']);
    
    // Registration requests
    Route::get('registration-requests', [AdminRegistrationRequestController::class, 'index'])->name('admin.registration-requests.index');
    Route::post('registration-requests/{request}/approve', [AdminRegistrationRequestController::class, 'approve'])->name('admin.registration-requests.approve');
    Route::post('registration-requests/{request}/reject', [AdminRegistrationRequestController::class, 'reject'])->name('admin.registration-requests.reject');
});
