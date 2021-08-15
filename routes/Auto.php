<?php
/********************************************************/
use App\Http\Controllers\Auto\Auto_cancel;
use App\Http\Controllers\Auto\Auto_enroll;
use App\Http\Controllers\Auto\Refresh;

/********************************************************/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    //    Route::post('auto_student', Auto_student::class.'@auto_student');

Route::post('auto_enroll', Auto_enroll::class.'@auto_enroll'); // auto enroll
Route::post('auto_cancel', Auto_cancel::class.'@auto_cancel'); // auto enroll
Route::post('refresh_f', Refresh::class.'@refresh_f')->middleware(type_admin::class);
