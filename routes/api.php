<?php

use App\Http\Controllers\Auth2Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\enroll_course;
use App\Http\Controllers\FeadbackController;
use App\Http\Controllers\GPA;
use App\Http\Controllers\intell_alg;
use App\Http\Controllers\is_attend;
use App\Http\Controllers\live_hour;
use App\Http\Controllers\show_s_degree;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\update_degree;
use App\Http\Controllers\Yellow;
use App\Http\Middleware\admin_;
use App\Http\Middleware\advisor_;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    ['middleware' => 'api', 'prefix' => 'auth'],
    function ($router) {
        Route::get('test', AuthController::class . '@test');


        Route::post('signup', AuthController::class . '@signup');
        Route::post('login', AuthController::class . '@login');
        Route::post('logout', AuthController::class . '@logout');

        Route::post('refresh', AuthController::class . '@refresh');
        Route::post('me', AuthController::class . '@me');

        Route::post('change_pass', Auth2Controller::class . '@change_pass');
        Route::post('update_user', AuthController::class . '@update_user')->middleware(admin_::class);
        Route::post('delete_user', AuthController::class . '@delete_user')->middleware(admin_::class);

        Route::post('sendresetpasswordemail', Auth2Controller::class . '@sendresetpasswordemail');
        Route::post('reset_pass',Auth2Controller::class.'@resetpassword');

        Route::post('search',AuthController::class.'@search');
    }
);

Route::group(
    ['middleware' => admin_::class, 'prefix' => 'private'],
    function ($router) {
        Route::post('Department', [Yellow::class,'Department']);  
        Route::post('Section', [Yellow::class,'Section']);
        Route::post('add_course', [Yellow::class,'add_course']); 
        Route::post('Pre_request', [Yellow::class,'Pre_request']);  
        Route::post('SHC', [Yellow::class,'SHC']);  
        // can't list all COURSES without link it with SHC [ SHC DISPLAY ]   

        Route::post('delete_Course', [Yellow::class,'delete_Course']);  
        Route::post('delete_section', [Yellow::class,'delete_section']);  
        Route::post('delete_Pre_request', [Yellow::class,'delete_Pre_request']);  
        Route::post('delete_SHC', [Yellow::class,'delete_SHC']);  
        Route::post('delete_SHC', [Yellow::class,'delete_SHC']);  
        Route::post('delete_department', [Yellow::class,'delete_department']); 
        Route::post('delete_feedback', FeadbackController::class . '@delete_feedback');

        Route::post('update_student', StudentController::class . '@update_student');
        Route::post('update_degree', [update_degree::class,'update_student_degree']);

    }
);

Route::group(
    ['middleware' => 'api', 'prefix' => 'service'],  
    function ($router) 
    {
        // doctorrrrrrrrrrrrrr
        
        Route::post('signature', [enroll_course::class,'signature']); 

        Route::post('cancel_course', [enroll_course::class,'cancel_course']); 

        Route::post('list_departemnts', [Yellow::class,'list_departemnts']); // CANOT LIST SCETIONS ONLY => SHC
        Route::post('list_stu', [StudentController::class,'list_stu']); 

        Route::post('list_c_sem', [Yellow::class,'list_c_sem']);  
        Route::get('list_courses', [Yellow::class,'list_courses']); 
        Route::post('show_courses', [intell_alg::class,'show_courses']);

        Route::post('enroll_course', [enroll_course::class,'enroll']);
        Route::post('layer', [is_attend::class,'layer']); // for attend LAYER 1 

        Route::get('messages', ChatController::class . '@fetchMessages');
        Route::post('messages', ChatController::class . '@sendMessage');

        Route::post('add_feedback', FeadbackController::class . '@add_feedback');
        Route::get('list_feedbacks', FeadbackController::class . '@list_feedbacks');

        Route::post('gpa', GPA::class.'@gpa_calc'); // GPA - DEGREE
        Route::post('show_s_degree', show_s_degree::class.'@show_s_degree'); // GPA - DEGREE

        
    }
);
