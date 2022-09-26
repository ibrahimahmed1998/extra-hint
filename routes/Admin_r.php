<?php
use App\Http\Middleware\type_admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/********************************************************/
use App\Http\Controllers\AUTH_USERS\Del_student;
use App\Http\Controllers\AUTH_USERS\Del_user;
use App\Http\Controllers\AUTH_USERS\Update_user; // test
use App\Http\Controllers\AUTH_USERS\Update_student;
use App\Http\Controllers\Yellow\Course98;
use App\Http\Controllers\Yellow\Department98;
use App\Http\Controllers\Yellow\Pre_req98;
use App\Http\Controllers\Yellow\Section98;
use App\Http\Controllers\Yellow\SHC98;

Route::group([ 'middleware' => type_admin::class ],function ($router){

    //Route::post('enter_degree', [Enter_degree::class,'enter_degree']);

    Route::post('department98', [Department98::class,'department98']);
    //Route::post('del_dep98', [Department98::class,'del_dep98']);

    Route::post('section98', [Section98::class,'section98']);
    //Route::post('del_sec98', [Section98::class,'del_sec98']);

    Route::post('create_course', [Course98::class,'create']);
    //Route::post('del_Course', [Course98::class,'delete']);

    Route::post('pre_req98', [Pre_req98::class,'pre_req98']);
    //Route::post('del_pr98', [Pre_req98::class,'del_pr98']);

    Route::post('create_shc', [SHC98::class,'create']);
    //Route::post('delete__shc', [SHC98::class,'delete']);
    });

 Route::group(
    ['middleware' => type_adv::class , 'api', 'prefix' => 'advisor'],
    function ($router)
    {
       Route::post('signature', [Signature::class,'signature'])->middleware(type_adv::class);
       Route::post('search_student', Search_student::class . '@search_student')->middleware(type_adv::class);
       Route::post('feedback98', Feedback98::class . '@feedback98');
       Route::post('del_feedback98', Feedback98::class . '@del_feedback98');
       Route::post('Layer_f', Layer::class . '@Layer_f');
    }
);