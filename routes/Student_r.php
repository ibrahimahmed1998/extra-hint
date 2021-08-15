<?php
/********************************************************/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/********************************************************/
use App\Http\Middleware\type_s;
use App\Http\Controllers\F_Student\Enroll_course;
use App\Http\Controllers\F_Student\Cancel_course;
/********************************************************/

            //  Route::post('attends', [Attends::class,'attends'])->middleware(type_s::class); // for attend LAYER 1   /////////////////////////////////////////////

            Route::post('enroll_course', [Enroll_course::class,'enroll_course'])->middleware(type_s::class);
            Route::post('cancel_course', [Cancel_course::class,'cancel_course'])->middleware(type_s::class);
            Route::post('current_courses', [Current_courses::class,'current_courses']);

            Route::post('show_degree', Show_degree::class.'@show_degree'); // GPA - DEGREE
            Route::post('byan_nga7', Byan_nga7::class.'@byan_nga7'); // GPA - DEGREE
            Route::post('Student_Records', Byan_nga7::class.'@Student_Records'); // GPA - DEGREE
            Route::post('intell_advise', [Intell_advise::class,'intell_advise']);
