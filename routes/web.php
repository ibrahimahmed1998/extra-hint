<?php

 use Illuminate\Support\Facades\Route;


// home
Route::get('/', function (){ return view('Home.main'); });
Route::get('/welcome', function (){ return view('welcome'); });

Route::get('/sec', function (){ return view('Dep_Sec.create_section'); });

Route::get('/here', function (){ return view('Home.new_temp'); });
Route::get('/login', function (){ return view('Auth.login'); });



Route::get('/s', function ()
{
    return view('s');
});
