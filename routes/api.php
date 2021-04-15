<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Student_Area;
use App\Http\Controllers\yellow_area;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(
    ['middleware' => 'api', 'prefix' => 'auth'],
    function ($router) 
    {
        Route::post('signup', AuthController::class . '@signup');
        Route::post('login', AuthController::class . '@login');
        Route::post('change_password', AuthController::class . '@change_password');
        Route::post('refresh', AuthController::class . '@refresh');
        Route::post('me', AuthController::class . '@me');
        Route::post('logout', AuthController::class . '@logout');
        Route::post('delete_user', AuthController::class . '@delete_user');
        Route::post('change_pass', AuthController::class . '@change_pass'); 
    }
);

Route::group(
    ['middleware' => 'api', 'prefix' => 'yellow'],
    function ($router) 
    {
        Route::post('Section', yellow_area::class . '@Section');
        Route::post('Department', yellow_area::class . '@Department');
        Route::post('Course', yellow_area::class . '@Course');
        Route::post('Pre_request', yellow_area::class . '@Pre_request');
        Route::post('SHC', yellow_area::class . '@SHC');
        Route::post('delete_Course', yellow_area::class . '@delete_Course');
    }
);

Route::group(
    ['middleware' => 'api', 'prefix' => 'Student'],
    function ($router) 
    {
        Route::post('Student', Student_Area::class . '@Student');
        Route::post('level_calc', Student_Area::class . '@level_calc');
        Route::post('show_courses', Student_Area::class . '@show_courses');
        Route::post('update_degree', Student_Area::class . '@update_student_degree');
        Route::post('cancel_course', Student_Area::class . '@cancel_course');
        Route::post('SCT', Student_Area::class . '@SCT');
    }
);
