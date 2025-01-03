<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AUTH_USERS\Current_courses;
use App\Http\Controllers\AUTH_USERS\Deep_search;
use App\Http\Controllers\AUTH_USERS\Enroll_course;
use App\Http\Controllers\AUTH_USERS\User_Data;
use App\Http\Controllers\Yellow\List_C;
use App\Http\Middleware\type_admin;
use Illuminate\Support\Facades\Route;

Route::get('/blog', function () { return view('wordpress.wp-admin.install');})->name('blog');

Route::get('/', function () { return view('Home.main');})->name('home');
Route::get('/soon', function () {return view('Home.soon');});
// Route::get('/logingate2', function () { return view('auth.login');})->name('/');
Route::get('/login', function () { return view('auth.login');})->name('login');
Route::get('/logingate2', function () { return view('Home.main');})->name('login_pop');

Route::post('/change_pass',[ User_Data::class ,'change_pass']);
Route::get('/register1', function () {return view('Home.register1');})->name('register1');
////////////////////////////////////////////////////////////////////////
Route::get('/myserivce', function() { return view('Serivce.general'); })->middleware(['auth']);
Route::post('/add_user',[ User_Data::class ,'add_user'])->name('add_user');
Route::get('/delete_user/{id}',[ User_Data::class ,'del_user'])->name('del_user');
////////////////////////////////////////////////////////////////////////
Route::get('/all_users',[ Deep_search::class ,'all_users'])->middleware(type_admin::class)->name('all_users');
Route::get('/user_update/{id}',[ Deep_search::class ,'student_data']);
Route::post('/user_update/{id}',[ User_Data::class ,'user_update']);
Route::get('/student_data/{id}',[ Deep_search::class ,'student_data']);
Route::get('/list_courses/{user_id}', [List_C::class,'read']);  
Route::get('/enroll_courses/{user_id}/{ccode}',[Enroll_course::class,'enroll_course2']);
Route::get('current_courses/{Student_id}', [Current_courses::class,'current_courses']);
////////////////////////////////////////////////////////////////////////

// Route::post('cancel_course', [Cancel_course::class,'cancel_course'])->middleware(type_s::class);

// Route::post('show_degree', Show_degree::class.'@show_degree'); // GPA - DEGREE
// Route::post('Student_Records', Byan_nga7::class.'@Student_Records'); // GPA - DEGREE
// Route::post('byan_nga7', Byan_nga7::class.'@byan_nga7'); // GPA - DEGREE

// Route::post('intell_advise', [Intell_advise::class,'intell_advise']);
// Route::post('attends', [Attends::class,'attends'])->middleware(type_s::class); // for attend LAYER 1   /////////////////////////////////////////////

require __DIR__.'/auth.php';
