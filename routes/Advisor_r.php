<?php
use App\Http\Controllers\F_Advisor\Enter_degree;
use App\Http\Controllers\F_Advisor\Attends;
use App\Http\Controllers\F_Advisor\Signature;
use App\Http\Controllers\F_Advisor\Search_student;
use App\Http\Controllers\F_Advisor\Layer;
use Illuminate\Http\Request;
use App\Http\Middleware\type_adv;

use Illuminate\Support\Facades\Route;



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
