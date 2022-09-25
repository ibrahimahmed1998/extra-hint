<?php

use App\Http\Controllers\AUTH_USERS\Add_user;
use App\Http\Controllers\AUTH_USERS\Change_pass;
use App\Http\Controllers\AUTH_USERS\Deep_search;
use App\Http\Middleware\type_admin;
use Illuminate\Support\Facades\Route;
 

Route::get('/', function () {return view('Home.main');});
Route::get('/register1', function () {return view('Home.register1');});


Route::get('/myserivce', function() { return view('Serivce.general'); })->middleware(['auth']);
Route::post('/add_user',[ Add_user::class ,'add_user'])->name('add_user'); // ->middleware(type_admin::class)->name('add_user');
Route::get('/all_users',[ Deep_search::class ,'all_users'])->middleware(type_admin::class)->name('all_users');
Route::get('/user_update/{id}',[ Deep_search::class ,'student_data']);
Route::get('/student_data/{id}',[ Deep_search::class ,'student_data']);

Route::get('/soon', function () {return view('Home.soon');});

 Route::post('/change_pass',[ Change_pass::class ,'change_pass']);


// Route::post('attends', [Attends::class,'attends'])->middleware(type_s::class); // for attend LAYER 1   /////////////////////////////////////////////
// Route::post('enroll_course', [Enroll_course::class,'enroll_course'])->middleware(type_s::class);
// Route::post('cancel_course', [Cancel_course::class,'cancel_course'])->middleware(type_s::class);
// Route::post('current_courses', [Current_courses::class,'current_courses']);

// Route::post('show_degree', Show_degree::class.'@show_degree'); // GPA - DEGREE
// Route::post('byan_nga7', Byan_nga7::class.'@byan_nga7'); // GPA - DEGREE
// Route::post('Student_Records', Byan_nga7::class.'@Student_Records'); // GPA - DEGREE
// Route::post('intell_advise', [Intell_advise::class,'intell_advise']);

// Route::group(['middleware' => 'api', 'prefix' => 'testing'],function ($router){
//     Route::post('test', Test::class.'@test');
// });


require __DIR__.'/auth.php';
