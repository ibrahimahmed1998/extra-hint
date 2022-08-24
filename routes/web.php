<?php

 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\AUTH_USERS\AuthController;
 

// home
Route::get('/', function (){ return view('Home.main'); });
Route::get('/myserivce', function (){ return view('Serivce.profile'); });

Route::get('/sec', function (){ return view('Dep_Sec.create_section'); });

Route::get('/here', function (){ return view('Home.new_temp'); });
Route::get('/login', function (){ return view('Auth.login'); });
Route::get('/logout', AuthController::class . '@logout');

 