
<?php
/********************************************************/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Z_CODEBASE\Test;
/********************************************************/

Route::group(['middleware' => 'api', 'prefix' => 'testing'],function ($router){
        Route::post('test', Test::class.'@test');
    });
