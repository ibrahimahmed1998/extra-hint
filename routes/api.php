<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('auth:api')->get('/user', function (Request $request)
 {
    return $request->user();
});

 
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router)
    {
        //Route::get('/route', AuthController::class . '@action');

    /*1*/Route::post('signin',AuthController::class .'@signin');
    /*2*/Route::post('verify/{verification_code}',AuthController::class.'@verifyUser');
    /*3*/Route::post('login',AuthController::class.'@login');
    /*4*/Route::post('edit_profile', AuthController::class.'@edit_profile');
    /*5*/Route::post('change_password', AuthController::class.'@change_password');
    /*6*/Route::Post('sendresetpasswordemail', AuthController::class.'@sendresetpasswordemail');
    /*7*/Route::post('reset_pass/{token}',AuthController::class.'@reset_password_2');
    /*8*/Route::post('refresh', AuthController::class.'@refresh');
    /*9*/Route::post('me', AuthController::class.'@me');
    /*10*/Route::post('logout',AuthController::class.'@logout');
    }
);
 