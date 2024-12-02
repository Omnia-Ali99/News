<?php

use App\Http\Controllers\Admin\Auth\LoginController;
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
});
 


Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'auth:admin'],function(){
    
    Route::get('home',function(){
        return view('admin.index');
    })->name('home');
});