<?php
/********************************************************/
use App\Http\Controllers\Yellow\List_C;
use App\Http\Controllers\Yellow\Course98;
use App\Http\Controllers\Yellow\Department98;
use App\Http\Controllers\Yellow\Pre_req98;
use App\Http\Controllers\Yellow\Section98;
use App\Http\Controllers\Yellow\SHC98;
use App\Http\Controllers\F_Advisor\Feedback98;

/********************************************************/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/********************************************************/

Route::group(['middleware' => 'api'],function ($router){

Route::get('department', [Department98::class,'list_departemnt']);
Route::post('list_section', [Section98::class,'list_section']);
Route::post('list_course', [List_C::class,'read']);  // all courses must DEPARTMENT [OPTIONAL::SECTION-LVL-SEMESTER]
Route::post('couuse_data', [Course98::class,'read'] );
Route::post('list_feedbacks', Feedback98::class . '@list_feedbacks');
});
