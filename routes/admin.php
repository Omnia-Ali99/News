<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['prefix'=>'admin','as'=>'admin.'],function(){

    Route::controller(LoginController::class)->group(function(){
        Route::get('login','showLoginForm')->name('login.show');
        Route::post('login/check','checkAuth')->name('login.check');
        Route::post('logout','logout')->name('logout');
    });

    Route::group(['prefix'=>'password','as'=>'password.'],function(){
        Route::controller(ForgotPasswordController::class)->group(function(){
            Route::get('email','showEmailForm')->name('email');
            Route::post('email','sendotp')->name('sendotp');
            Route::get('verify/{email}','showotpForm')->name('showotpForm');
            Route::post('verify','verifyotp')->name('verifyotp');    
        });
     
        Route::controller(ResetPasswordController::class)->group(function(){
            Route::get('reset/{email}','showResetForm')->name('resetForm');
            Route::post('reset','resetPassword')->name('reset');
        });
        


    });
});
 


Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'auth:admin'],function(){
    
    Route::get('home',function(){
        return view('admin.index');
    })->name('home');
});

