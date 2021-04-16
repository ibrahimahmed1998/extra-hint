<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth_Controller;
use App\Http\Controllers\Student_Area;
use App\Http\Controllers\Yellow_Area;
use App\Http\Controllers\Admin;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(
    ['middleware' => 'api', 'prefix' => 'auth'],
    function ($router) 
    {
        Route::post('signup', Auth_Controller::class . '@signup');
        Route::post('login', Auth_Controller::class . '@login');
        Route::post('change_password', Auth_Controller::class . '@change_password');
        Route::post('refresh', Auth_Controller::class . '@refresh');
        Route::post('me', Auth_Controller::class . '@me');
        Route::post('logout', Auth_Controller::class . '@logout');
        Route::post('delete_user', Auth_Controller::class . '@delete_user');
        Route::post('change_pass', Auth_Controller::class . '@change_pass'); 
    }
);

Route::group(
    ['middleware' => 'api', 'prefix' => 'yellow'],
    function ($router) 
    {
        Route::post('Section', Yellow_Area::class . '@Section');
        Route::post('Department', Yellow_Area::class . '@Department');
        Route::post('Course', Yellow_Area::class . '@Course');
        Route::post('Pre_request', Yellow_Area::class . '@Pre_request');
        Route::post('SHC', Yellow_Area::class . '@SHC');
        Route::post('delete_Course', Yellow_Area::class . '@delete_Course');
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

Route::group(
    ['middleware' => 'api', 'prefix' => 'admin'],
    function ($router) 
    {
        Route::post('search', Admin::class . '@search');
       
    }
);
