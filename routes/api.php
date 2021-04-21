<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth_Controller;
use App\Http\Controllers\Admin;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\AttendController;
use App\Http\Controllers\enroll_course;
use App\Http\Controllers\FeadbackController;
use App\Http\Controllers\intell_alg;
use App\Http\Controllers\is_attend;
use App\Http\Controllers\S_GPA;
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
        Route::post('signup', Auth_Controller::class . '@signup');
        Route::post('login', Auth_Controller::class . '@login');
        Route::post('refresh', Auth_Controller::class . '@refresh');
        Route::post('me', Auth_Controller::class . '@me');
        Route::post('logout', Auth_Controller::class . '@logout');
        Route::post('change_pass', Auth_Controller::class . '@change_pass');
        Route::post('list_all', Auth_Controller::class . '@list_all')->middleware(admin_::class); //users
        Route::post('delete_user', Auth_Controller::class . '@delete_user')->middleware(admin_::class);
        
    }
);

Route::group(
    ['middleware' => admin_::class, 'prefix' => 'yellow'],
    function ($router) {
        Route::post('Section', [Yellow::class,'Section']);  
        Route::post('Department', [Yellow::class,'Department']);  
        Route::post('Course', [Yellow::class,'Course']);  
        Route::post('Pre_request', [Yellow::class,'Pre_request']);  
        Route::post('SHC', [Yellow::class,'SHC']);  
        Route::post('delete_Course', [Yellow::class,'delete_Course']);  

    }
);

Route::group(
    ['middleware' => 'api', 'prefix' => 'student'],
    function ($router)
     {
        Route::post('update_degree', [update_degree::class,'update_degree'])->middleware(advisor_::class);
        Route::post('show_courses', [intell_alg::class,'show_courses']);
        Route::post('enroll_course', [enroll_course::class,'enroll']);  
        Route::post('cancel_course', [enroll_course::class,'cancel_course']); 
        Route::post('layer', [is_attend::class,'layer']); 
    }
);

Route::group(
    ['middleware' => admin_::class, 'prefix' => 'admin'],
    function ($router) {
        Route::post('add_student', StudentController::class . '@add_student');
        Route::post('delete_student', StudentController::class . '@add_student');
        Route::post('update_student', StudentController::class . '@update_student');
    }
);

Route::group(
    ['middleware' => 'api', 'prefix' => 'general'],
    function ($router) 
    {
        Route::get('messages', ChatsController::class . '@fetchMessages');
        Route::post('messages', ChatsController::class . '@sendMessage');
        Route::post('add_feedback', FeadbackController::class . '@add_feedback');
        Route::post('delete_feedback', FeadbackController::class . '@delete_feedback');
        Route::post('S_GPA', S_GPA::class.'@gpa_calc_f');
    }
);

/* old req : 

        //Route::post('C_GPA', C_GPA::class.'@gpa_calc_f');
        //Route::post('lvl_calc', lvl_calc::class.'@lvl_calc_f');

*/
