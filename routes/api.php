<?php
use App\Http\Controllers\AUTH_USERS\Reset_pass;
use App\Http\Controllers\AUTH_USERS\AuthController;
use App\Http\Controllers\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request){return $request->user(); });

Route::group(['middleware' => 'api', 'prefix' => 'auth'],function ($router){
    
    Route::post('sendresetpasswordemail',Reset_pass::class . '@sendresetpasswordemail');
    Route::post('reset_pass',Reset_pass::class.'@resetpassword');
    Route::post('refresh', AuthController::class . '@refresh');
    Route::post('me', AuthController::class . '@me');
 });

Route::group(['middleware' => 'api', 'prefix' => 'chat'],function ($router){
        Route::get('messages', Chat::class . '@fetchMessages');
        Route::post('messages', Chat::class . '@sendMessage');
    });

Route::post('auto_enroll', Auto_enroll::class.'@auto_enroll'); // auto enroll
Route::post('auto_cancel', Auto_cancel::class.'@auto_cancel'); // auto enroll
Route::post('refresh_f', Refresh::class.'@refresh_f')->middleware(type_admin::class);
//    Route::post('auto_student', Auto_student::class.'@auto_student');
