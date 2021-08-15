<?php

 use Illuminate\Support\Facades\Route;


// home
Route::get('/', function (){ return view('Home.main'); });
Route::get('/sec', function (){ return view('Dep_Sec.create_section'); });



Route::get('/s', function ()
{
    return view('s');
});
