<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/leaderboard/students', [StudentController::class, 'leaderboards'])->name('student-leaderboard');
    Route::get('/leaderboard/teachers', [TeacherController::class, 'leaderboards'])->name('teacher-leaderboard');
    Route::get('teacher/profile/{id}', [TeacherController::class, 'profile'])->name('teacher-profile');
    Route::get('student/profile/{id}', [StudentController::class, 'profile'])->name('student-profile');
    Route::post('thread/', [ThreadController::class, 'postThread'])->name('thread-post');
    Route::post('thread/comment', [ThreadController::class, 'postComment'])->name('thread-post-comment');
    Route::controller(CourseController::class)->prefix('course')->name('course-')->group(function () {
        Route::get('/', 'courses')->name('courses');
        Route::get('/{id}', 'courseDetail')->name('detail');
        Route::controller(SessionController::class)->prefix('{id}/session')->group(function () {
            Route::get('/session', 'getSessionData')->name('session-data');
            Route::get('/people', 'getPeopleData')->name('people-data');
            Route::put('/update', 'updateDescription')->name('session-description-update');
            Route::controller(MaterialController::class)->prefix('material')->name('material-')->group(function () {
                Route::get('/', 'getMaterialFile')->name('download');
                Route::post('/add', 'addMaterial')->name('add');
                Route::put('/edit', 'editMaterial')->name('edit');
                Route::delete('/delete', 'deleteMaterial')->name('delete');
            });
            Route::controller(AttendanceController::class)->prefix('attendance')->name('attendance-')->group(function () {
                Route::get('/filter', 'filterAttendance')->name('filter');
                Route::post('/save', 'saveAttendance')->name('save');
            });
        });
    });

    Route::middleware('admin-only')->group(function () {
        Route::get('/', [AdminController::class, 'home'])->name('admin-dashboard');

        Route::prefix('setting')->group(function () {
            Route::get('/', [AdminController::class, 'setting'])->name('setting');

            Route::put('/edit', [OrganizationController::class, 'update'])->name('organization-edit');
        });

        Route::prefix('student')->group(function () {
            Route::get('/list', [AdminController::class, 'studentList'])->name('student-list');
            Route::get('/add', [AdminController::class, 'studentAdd'])->name('student-add');
            Route::get('/edit/{id}', [AdminController::class, 'studentEdit'])->name('student-edit');
            Route::get('/detail/{id}', [AdminController::class, 'studentDetail'])->name('student-detail');

            Route::post('/add', [StudentController::class, 'create'])->name('student-add');
            Route::put('/edit/{id}', [StudentController::class, 'update'])->name('student-edit');
            Route::delete('/delete/{id}', [StudentController::class, 'delete'])->name('student-delete');
        });

        Route::prefix('teacher')->group(function () {
            Route::get('/list', [AdminController::class, 'teacherList'])->name('teacher-list');
            Route::get('/add', [AdminController::class, 'teacherAdd'])->name('teacher-add');
            Route::get('/edit/{id}', [AdminController::class, 'teacherEdit'])->name('teacher-edit');
            Route::get('/detail/{id}', [AdminController::class, 'teacherDetail'])->name('teacher-detail');

            Route::post('/add', [TeacherController::class, 'create'])->name('teacher-add');
            Route::put('/edit/{id}', [TeacherController::class, 'update'])->name('teacher-edit');
            Route::delete('/delete/{id}', [TeacherController::class, 'delete'])->name('teacher-delete');
        });

        Route::prefix('course')->group(function () {
            Route::get('/list', [AdminController::class, 'courseList'])->name('course-list');
            Route::get('/add', [AdminController::class, 'courseAdd'])->name('course-add');
            Route::get('/edit/{id}', [AdminController::class, 'courseEdit'])->name('course-update');

            Route::post('/add', [CourseController::class, 'create'])->name('course-add');
            Route::delete('/delete/{id}', [CourseController::class, 'delete'])->name('course-delete');
            Route::put('/edit/{id}', [CourseController::class, 'update'])->name('course-update');
        });

        Route::prefix('period')->group(function () {
            Route::get('/list', [AdminController::class, 'periodList'])->name('period-list');
            Route::get('/add', [AdminController::class, 'periodAdd'])->name('period-add');
            Route::get('/edit/{id}', [AdminController::class, 'periodEdit'])->name('period-update');

            Route::post('/add', [PeriodController::class, 'create'])->name('period-add');
            Route::delete('/delete/{id}', [PeriodController::class, 'delete'])->name('period-delete');
            Route::put('/edit/{id}', [PeriodController::class, 'update'])->name('period-update');
        });

        Route::prefix('class')->group(function () {
            Route::get('/list', [AdminController::class, 'classList'])->name('class-list');
            Route::get('/add', [AdminController::class, 'classAdd'])->name('class-add');
            Route::get('/edit/{id}', [AdminController::class, 'classEdit'])->name('class-update');
            Route::get('/detail/{id}', [AdminController::class, 'classDetail'])->name('class-detail');

            Route::post('/add', [ClassroomController::class, 'create'])->name('class-add');
            Route::delete('/delete/{id}', [ClassroomController::class, 'delete'])->name('class-delete');
            Route::put('/edit/{id}', [ClassroomController::class, 'update'])->name('class-update');
        });

        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'home'])->name('admin-dashboard');
            Route::get('/profile/{id}', [AdminController::class, 'profile']);

            Route::put('/updateProfile', [AdminController::class, 'saveProfiles'])->name('update-admin-profile');
            Route::put('/updatePassword', [AdminController::class, 'savePassword'])->name('update-admin-password');
            Route::put('/updatePhoto', [AdminController::class, 'savePhoto'])->name('update-admin-photo');
        });
    });
    Route::middleware('teacher-only')->group(function () {
        Route::prefix('teacher')->group(function () {
            Route::get('/', [TeacherController::class, 'home'])->name('teacher-dashboard');
            Route::put('/updateProfile', [TeacherController::class, 'saveProfiles'])->name('update-teacher-profile');
            Route::put('/updatePhoto', [TeacherController::class, 'savePhoto'])->name('update-teacher-photo');
            Route::put('/updatePassword', [TeacherController::class, 'savePassword'])->name('update-teacher-password');
        });
    });
    Route::middleware('student-only')->group(function () {
        Route::prefix('student')->group(function () {
            Route::get('/', [StudentController::class, 'home'])->name('student-dashboard');
            Route::put('/updateProfile', [StudentController::class, 'saveProfiles'])->name('update-student-profile');
            Route::put('/updatePhoto', [StudentController::class, 'savePhoto'])->name('update-student-photo');
            Route::put('/updatePassword', [StudentController::class, 'savePassword'])->name('update-student-password');

            Route::get('/course', [CourseController::class, 'studentCourse'])->name('student-course');
            Route::get('/course/{id}', [CourseController::class, 'studentCourseDetail'])->name('student-course-detail');
        });
    });

    Route::prefix('post')->group(function () {
        Route::get('/create', [PostController::class, 'index'])->name('post-create-view');
        Route::get('/list', [PostController::class, 'list'])->name('post-list');
        Route::get('/list-report', [PostController::class, 'listReport'])->name('post-report-view');
        Route::get('/list-report/{id}', [PostController::class, 'listReportDetail'])->name('post-report-detail');
        Route::get('/edit/{id}', [PostController::class, 'postUpdate'])->name('post-update');

        Route::post('/create', [PostController::class, 'create'])->name('post-create');
        Route::put('/edit/{id}', [PostController::class, 'update'])->name('post-update');
        Route::delete('/delete/{id}', [PostController::class, 'delete'])->name('post-delete');
        Route::put('/report/{id}', [PostController::class, 'report'])->name('post-report');
        Route::post('/comment/{id}', [PostController::class, 'comment'])->name('post-comment-create');
        Route::get('/detail/{id}', [PostController::class, 'detail'])->name('post-detail');
    });

    Route::get('/logout', [AuthController::class, 'signout'])->name('logout');
});

// Account Login
Route::middleware('guest')->group(function () {
    Route::get('/{role}/signin', [AuthController::class, 'signin'])->name('login')->defaults('role', 'student');
    Route::post('/signin/{role}', [AuthController::class, 'authentication']);

    Route::get('/signup', [AuthController::class, 'signup']);
    Route::post('/signup', [AuthController::class, 'store']);
});
