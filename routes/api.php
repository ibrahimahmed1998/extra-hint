<?php
/********************************************************/
use App\Http\Controllers\AUTH_USERS\Add_user;
use App\Http\Controllers\AUTH_USERS\Change_pass;
use App\Http\Controllers\AUTH_USERS\Login;
use App\Http\Controllers\AUTH_USERS\Reset_pass;
use App\Http\Controllers\AUTH_USERS\Search_user;
use App\Http\Controllers\AUTH_USERS\Update_user;
use App\Http\Controllers\AUTH_USERS\AuthController;
use App\Http\Controllers\AUTH_USERS\Del_student;
use App\Http\Controllers\AUTH_USERS\Del_user;
use App\Http\Controllers\AUTH_USERS\test_verify_user;
/********************************************************/
use App\Http\Controllers\Enroll_Course\Enroll_course;
use App\Http\Controllers\Enroll_Course\Cancel_course;
use App\Http\Controllers\Enroll_Course\Show_degree;
/********************************************************/
use App\Http\Controllers\Student\GPA;
use App\Http\Controllers\F_Advisor\Search_student;
use App\Http\Controllers\Student\Update_student;
/********************************************************/
use App\Http\Controllers\Yellow\Course98;
use App\Http\Controllers\Yellow\Department98;
use App\Http\Controllers\Yellow\Pre_req98;
use App\Http\Controllers\Yellow\Section98;
use App\Http\Controllers\Yellow\SHC98;
use App\Http\Controllers\Yellow\test_list_sem;
/********************************************************/
use App\Http\Controllers\Chat;
/********************************************************/
use App\Http\Controllers\F_Advisor\Enter_degree;
use App\Http\Controllers\F_Advisor\Feedback98;
use App\Http\Controllers\F_Advisor\Attends;
use App\Http\Controllers\F_Advisor\Signature;
 
/********************************************************/
use App\Http\Controllers\intell_alg;
use App\Http\Controllers\Student\CGPA;

/********************************************************/
use App\Http\Controllers\Test;
/*||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
use App\Http\Middleware\type_s;
use App\Http\Middleware\type_adv;
use App\Http\Middleware\type_admin;
/*||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) 
{
    return $request->user();
});

Route::group(
    ['middleware' => 'api', 'prefix' => 'auth'],
    function ($router) 
    {
        Route::post('add_user', Add_user::class . '@add_user');
        Route::post('login', Login::class . '@login');
        Route::post('change_pass', Change_pass::class . '@change_pass');
      
        Route::post('sendresetpasswordemail',Reset_pass::class . '@sendresetpasswordemail');
        Route::post('reset_pass',Reset_pass::class.'@resetpassword');

        Route::post('logout', AuthController::class . '@logout');
        Route::post('refresh', AuthController::class . '@refresh');
        Route::post('me', AuthController::class . '@me');
    }
);

Route::group(
    ['middleware' => type_admin::class, 'prefix' => 'auth'],
    function ($router) 
    {
        Route::post('update_user', Update_user::class . '@update_user');
        Route::post('del_user', Del_user::class . '@del_user');
        Route::post('del_student', Del_student::class . '@del_student');
        Route::post('search_user',Search_user::class.'@search_user');
    }
);

Route::group(
    ['middleware' => type_admin::class, 'prefix' => 'private'],
    function ($router) 
    {
        Route::post('department98', [Department98::class,'department98']); 
        Route::post('del_dep98', [Department98::class,'del_dep98']); 

        Route::post('section98', [Section98::class,'section98']);
        Route::post('delete_section', [Section98::class,'delete_section']);  

        Route::post('course98', [Course98::class,'course98']); 
        Route::post('del_Course', [Course98::class,'del_Course']);  

        Route::post('pre_req98', [Pre_req98::class,'pre_req98']);  
        Route::post('del_pr98', [Pre_req98::class,'del_pr98']);  

        Route::post('shc98', [SHC98::class,'shc98']);  
        Route::post('del_shc', [SHC98::class,'del_shc']);  

        // can't list all COURSES without link it with SHC [ SHC DISPLAY ]   
        Route::post('update_student', Update_student::class . '@update_student');

        Route::post('cgpa', [CGPA::class,'cgpa']);
        Route::post('gpa', [GPA::class,'gpa']);
    }
);

Route::group(
    ['middleware' => type_adv::class , 'api', 'prefix' => 'advisor'],  
    function ($router) 
    {
        Route::post('signature', [Signature::class,'signature'])->middleware(type_adv::class);   
        Route::post('enter_degree', [Enter_degree::class,'enter_degree']);
        Route::post('search_student', Search_student::class . '@search_student')->middleware(type_adv::class); 
        Route::post('feedback98', Feedback98::class . '@feedback98');
        Route::post('del_feedback98', Feedback98::class . '@del_feedback98');
    }
);

Route::group(
    ['middleware' => 'api', 'prefix' => 'service'],  
    function ($router) 
    {
        Route::post('list_departemnts', [Department98::class,'list_departemnts']); 
        /***************** CANOT LIST SCETIONS ONLY => SHC ****************************/
        Route::post('enroll_course', [Enroll_course::class,'enroll_course'])->middleware(type_s::class);   
        Route::post('cancel_course', [Cancel_course::class,'cancel_course'])->middleware(type_s::class);

        Route::post('layer', [Attends::class,'layer']); // for attend LAYER 1   /////////////////////////////////////////////

        Route::post('list_c_sem', [test_list_sem::class,'list_c_sem']);  
        Route::get('list_courses', [Yellow::class,'list_courses']); 
        Route::post('show_courses', [intell_alg::class,'show_courses']);

        Route::get('list_feedbacks', Feedback98::class . '@list_feedbacks');

        Route::post('gpa', GPA::class.'@gpa'); // GPA - DEGREE
        Route::post('show_degree', Show_degree::class.'@show_degree'); // GPA - DEGREE

        Route::post('test', Test::class.'@test');     

        /************************* chat ****************************/
        Route::get('messages', Chat::class . '@fetchMessages');
        Route::post('messages', Chat::class . '@sendMessage');
    }
);
