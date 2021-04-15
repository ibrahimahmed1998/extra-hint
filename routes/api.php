<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Service1;
use App\Http\Controllers\yellow_area;


Route::middleware('auth:api')->get('/user', function (Request $request)
 {
    return $request->user();
});

 
Route::group(['middleware'=>'api','prefix'=>'auth'], function ($router)
    {
    /* Have not [sign_in || Register Method , Verify Method , edit_profile , send_reset_password_email] 
    Becouse Adminstrator Add Users Dirctly 
    , So Needn't to Verify there Mails 
    , Also User Can't Dirctly Edit his Profile , Must ask Admin to make it for him 
    send_reset_password_email , Soln : Call Center  ( Adminstrator )
    */
    Route::post('signup'          ,AuthController::class.'@signup');
    Route::post('login'           ,AuthController::class.'@login');
    Route::post('change_password' ,AuthController::class.'@change_password');
    Route::post('refresh'         ,AuthController::class.'@refresh');
    Route::post('me'              ,AuthController::class.'@me');
    Route::post('logout'          ,AuthController::class.'@logout');
    Route::post('Student'         ,AuthController::class.'@Student');
    Route::post('delete_user'     ,AuthController::class.'@delete_user');
    Route::post('change_pass'     ,AuthController::class.'@change_pass');

    

    Route::post('Section'         ,yellow_area::class.'@Section');
    Route::post('Department'      ,yellow_area::class.'@Department');
    Route::post('Course'          ,yellow_area::class.'@Course');
    Route::post('Pre_request'     ,yellow_area::class.'@Pre_request');
    Route::post('SHC'             ,yellow_area::class.'@SHC');
    Route::post('SCT'             ,yellow_area::class.'@SCT');
    Route::post('update_student_degree'      ,yellow_area::class.'@update_student_degree');


    Route::post('level_calc'      ,Service1::class.'@level_calc');
    Route::post('show_courses'      ,Service1::class.'@show_courses');

    
    
    
    
    }
);
 
Route::group(['middleware'=>'api','prefix'=>'ServiceOne'], function ($router)
    {

    }
);