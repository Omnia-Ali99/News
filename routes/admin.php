<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\admin\setting\SettingController;
use App\Http\Controllers\Admin\User\UserController;
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
    
    Route::resource('users',UserController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('posts',PostController::class);



    Route::get('users/status/{id}',[UserController::class,'changeStatus'])->name('users.changeStatus');
    Route::get('Categories/status/{id}',[CategoryController::class,'changeStatus'])->name('categories.changeStatus');
    Route::get('posts/status/{id}',[PostController::class,'changeStatus'])->name('posts.changeStatus');
    Route::post('posts/image/delete/{image_id}' , [PostController::class,'deletePostImage'])->name('posts.image.delete');


    Route::controller(SettingController::class)->prefix('settings')->name('settings.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','update')->name('update');
    });

    Route::get('home',function(){
        return view('admin.index');
    })->name('home');
});

