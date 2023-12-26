<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('admin', 'AdminCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('course', 'CourseCrudController');
    Route::crud('course-user', 'CourseUserCrudController');
    Route::crud('group', 'GroupCrudController');
    Route::crud('teacher', 'TeacherCrudController');
    Route::crud('course-group', 'CourseGroupCrudController');
    Route::crud('course-teacher', 'CourseTeacherCrudController');
    Route::crud('logs', 'LogsCrudController');
    Route::crud('comment', 'CommentUserCrudController');
}); // this should be the absolute last line of this file
