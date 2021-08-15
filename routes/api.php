<?php
/********************************************************/
use App\Http\Controllers\AUTH_USERS\Add_user;
use App\Http\Controllers\AUTH_USERS\Change_pass;
use App\Http\Controllers\AUTH_USERS\Login;
use App\Http\Controllers\AUTH_USERS\Reset_pass;
use App\Http\Controllers\AUTH_USERS\Deep_search;
use App\Http\Controllers\AUTH_USERS\AuthController;
/********************************************************/
use App\Http\Controllers\F_Student\Show_degree;
use App\Http\Controllers\F_Student\Byan_nga7;
use App\Http\Controllers\F_Student\Current_courses;
use App\Http\Controllers\F_Student\Intell_advise;
/********************************************************/
use App\Http\Controllers\Chat;
use App\Http\Controllers\List_database;
/********************************************************/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request){
    return $request->user(); });

Route::group(['middleware' => 'api', 'prefix' => 'auth'],function ($router){
    Route::post('list_database', List_database::class . '@list_database');
    Route::post('login', Login::class . '@login');
    Route::post('change_pass', Change_pass::class . '@change_pass');
    Route::post('sendresetpasswordemail',Reset_pass::class . '@sendresetpasswordemail');
    Route::post('reset_pass',Reset_pass::class.'@resetpassword');
    Route::post('logout', AuthController::class . '@logout');
    Route::post('refresh', AuthController::class . '@refresh');
    Route::post('me', AuthController::class . '@me');
    Route::post('deep_search',Deep_search::class.'@deep_search');
 });

Route::group(['middleware' => 'api', 'prefix' => 'chat'],function ($router){
        Route::get('messages', Chat::class . '@fetchMessages');
        Route::post('messages', Chat::class . '@sendMessage');
    });

