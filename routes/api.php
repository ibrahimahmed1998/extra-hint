<?php
 use App\Http\Controllers\add_student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth_Controller;
use App\Http\Controllers\Admin;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\Stu;
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
    }
);

Route::group(
    ['middleware' => admin_::class, 'prefix' => 'yellow'],
    function ($router) {
         Route::post('Section', [Yellow::class,'Section']); //->middleware(admin_::class);
        Route::post('Department', [Yellow::class,'Department']); //->middleware(admin_::class);
        Route::post('Course', [Yellow::class,'Course']); //->middleware(admin_::class);
        Route::post('Pre_request', [Yellow::class,'Pre_request']); //->middleware(admin_::class);
        Route::post('SHC', [Yellow::class,'SHC']); //->middleware(admin_::class);
        Route::post('delete_Course', [Yellow::class,'delete_Course']); //->middleware(admin_::class);
    }
);

Route::group(
    ['middleware' => 'api', 'prefix' => 'student'],
    function ($router) {
        Route::post('update_degree', [Stu::class,'update_student_degree'])->middleware(advisor_::class);
        Route::post('level_calc', [Stu::class,'level_calc']);
        Route::post('show_courses', [Stu::class,'show_courses']);
        Route::post('SCT', [Stu::class,'SCT']); // student has course 
    }
);

Route::group(
    ['middleware' => admin_::class, 'prefix' => 'admin'],
    function ($router) {
        Route::post('add_student', add_student::class . '@add_student');
        Route::post('search', Admin::class . '@search');
        Route::post('delete_user', Admin::class . '@delete_user');
        Route::post('cancel_course', Admin::class . '@cancel_course');
    }
);

Route::group(
    ['middleware' => 'api', 'prefix' => 'chat'],
    function ($router) {
        Route::get('/', ChatsController::class . '@index');
        Route::get('messages', ChatsController::class . '@fetchMessages');
        Route::post('messages', ChatsController::class . '@sendMessage');
    }
);
