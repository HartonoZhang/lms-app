<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExpSettingController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
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
    Route::get('admin/profile/{id}', [AdminController::class, 'profile']);

    Route::prefix('thread')->group(function () {
        Route::get('/{id}', [ThreadController::class, 'detail'])->name('thread-detail');
        Route::post('/add', [ThreadController::class, 'postThread'])->name('thread-post');
        Route::post('/comment/{id}', [ThreadController::class, 'postThreadComment'])->name('thread-comment-create');

        Route::put('/update/{id}', [ThreadController::class, 'update'])->name('thread-update');
        Route::delete('/delete/{session}/{thread}', [ThreadController::class, 'delete'])->name('thread-delete');
    });

    Route::middleware('admin-only')->group(function () {
        Route::get('/', [AdminController::class, 'home'])->name('admin-dashboard');

        Route::prefix('setting')->group(function () {
            Route::get('/', [AdminController::class, 'setting'])->name('setting');

            Route::put('/edit', [OrganizationController::class, 'update'])->name('organization-edit');
            Route::put('/exp-edit', [ExpSettingController::class, 'update'])->name('exp-setting-edit');
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

            Route::get('/calender', [TeacherController::class, 'calender'])->name('teacher-calender');

            Route::prefix('quest')->group(function () {
                Route::get('/', [QuestController::class, 'teacherView'])->name('teacher-quest');
                Route::get('/create', [QuestController::class, 'createQuestion'])->name('create-question');
                Route::post('/create', [QuestController::class, 'addQuestion'])->name('create-question');
                Route::get('/edit/{id}', [QuestController::class, 'updateQuestion'])->name('update-question');
                Route::put('/edit/{id}', [QuestController::class, 'editQuestion'])->name('update-question');
                Route::delete('/delete/{id}', [QuestController::class, 'deleteQuestion'])->name('delete-question');
            });

            Route::prefix('course')->group(function () {
                Route::get('/', [CourseController::class, 'teacherCourses'])->name('teacher-course');
                Route::get('/{id}', [CourseController::class, 'teacherCourseDetailSession'])->name('teacher-course-detail');
                Route::get('/{id}/assignment', [CourseController::class, 'teacherCourseDetailAssignment'])->name('teacher-course-detail-assignment');
                Route::get('/{id}/people', [CourseController::class, 'teacherCourseDetailPeople'])->name('teacher-course-detail-people');
                Route::get('/{id}/score', [CourseController::class, 'teacherCourseDetailScore'])->name('teacher-course-detail-score');

                Route::get('/{id}/create-session', [SessionController::class, 'createSession'])->name('create-session');
                Route::post('/{id}/create-session', [SessionController::class, 'addSession'])->name('create-session');

                Route::get('/update-session/{id}', [SessionController::class, 'updateSession'])->name('update-session');
                Route::put('/update-session/{id}', [SessionController::class, 'editSession'])->name('update-session');
                Route::delete('/delete-session/{id}', [SessionController::class, 'deleteSession'])->name('delete-session');

                Route::post('/create-material', [MaterialController::class, 'addMaterial'])->name('create-material');
                Route::delete('/delete-material/{id}', [MaterialController::class, 'deleteMaterial'])->name('delete-material');

                Route::post('/{id}/attendance/{sessionId}/save', [AttendanceController::class, 'saveAttendance'])->name('save-attendance');

                Route::get('/{classroom}/assignment/create', [TaskController::class, 'createTask'])->name('create-task');
                Route::post('/{classroom}/assignment/create', [TaskController::class, 'addTask'])->name('create-task');

                Route::get('/{classroom}/assignment/{task}', [TaskController::class, 'taskDetail'])->name('task-detail');

                Route::get('/{classroom}/assignment/{task}/edit', [TaskController::class, 'updateTask'])->name('update-task');
                Route::put('/{classroom}/assignment/{task}/edit', [TaskController::class, 'editTask'])->name('update-task');

                Route::delete('/{classroom}/assignment/{task}/delete', [TaskController::class, 'deleteTask'])->name('delete-task');

                Route::put('/assignment/{task}/done/{student}', [TaskController::class, 'doneUpload'])->name('done-upload');
                Route::put('/assignment/{task}/revision/{student}', [TaskController::class, 'revisionUpload'])->name('revision-upload');

                Route::get('/{classroom}/score/{student}/update', [ClassroomController::class, 'updateStudentScore'])->name('student-score-update');
                Route::put('/{classroom}/score/{student}/update', [ClassroomController::class, 'editStudentScore'])->name('student-score-update');
            });
        });
    });
    Route::middleware('student-only')->group(function () {
        Route::prefix('student')->group(function () {
            Route::get('/', [StudentController::class, 'home'])->name('student-dashboard');
            Route::put('/updateProfile', [StudentController::class, 'saveProfiles'])->name('update-student-profile');
            Route::put('/updatePhoto', [StudentController::class, 'savePhoto'])->name('update-student-photo');
            Route::put('/updatePassword', [StudentController::class, 'savePassword'])->name('update-student-password');

            Route::get('/calender', [StudentController::class, 'calender'])->name('student-calender');

            Route::prefix('course')->group(function () {
                Route::get('/', [CourseController::class, 'studentCourse'])->name('student-course');
                Route::get('/{id}', [CourseController::class, 'studentCourseDetailSession'])->name('student-course-detail');
                Route::get('/{id}/assignment', [CourseController::class, 'studentCourseDetailAssignment'])->name('student-course-detail-assignment');
                Route::get('/{id}/attendance', [CourseController::class, 'studentCourseDetailAttendace'])->name('student-course-detail-attendance');
                Route::get('/{id}/people', [CourseController::class, 'studentCourseDetailPeople'])->name('student-course-detail-people');
                Route::get('/{id}/score', [CourseController::class, 'studentCourseDetailScore'])->name('student-course-detail-score');
            });

            Route::post('/task-upload/{id}', [TaskController::class, 'taskUpload'])->name('task-upload');

            Route::prefix('quest')->group(function () {
                Route::get('/', [QuestController::class, 'studentView'])->name('student-quest');
                Route::get('/{id}', [QuestController::class, 'doQuest'])->name('student-do-quest');
                Route::get('/{id}/result', [QuestController::class, 'questResult'])->name('quest-answer-result');
                Route::post('/{id}/result', [QuestController::class, 'validateQuestAnswer'])->name('validate-quest-answer');
            });
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

    Route::get('/signup', [AuthController::class, 'signup'])->name('registration');
    Route::get('/signup/organization', [AuthController::class, 'createOrganization'])->name('registration-organization');
    Route::post('/signup', [AuthController::class, 'storeUser'])->name('create-admin');
    Route::post('/signup/organization', [AuthController::class, 'storeOrganization'])->name('create-organization');
});
