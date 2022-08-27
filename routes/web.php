<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('Home.main');});

Route::get('/myserivce', function() { return view('Serivce.general'); })->middleware(['auth'])->name('myserivce');
 

require __DIR__.'/auth.php';
