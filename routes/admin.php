<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Admin\Authorization\AuthorizationController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\GeneralSearchController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Notification\NotificationController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Profile\ProfileController;
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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('login.show');
        Route::post('login/check', 'checkAuth')->name('login.check');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::get('email', 'showEmailForm')->name('email');
            Route::post('email', 'sendotp')->name('sendotp');
            Route::get('verify/{email}', 'showotpForm')->name('showotpForm');
            Route::post('verify', 'verifyotp')->name('verifyotp');
        });

        Route::controller(ResetPasswordController::class)->group(function () {
            Route::get('reset/{email}', 'showResetForm')->name('resetForm');
            Route::post('reset', 'resetPassword')->name('reset');
        });
    });
});



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('search', [GeneralSearchController::class, 'search'])->name('search');

    Route::resource('authorizations', AuthorizationController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::resource('admins', AdminController::class);




    Route::get('users/status/{id}', [UserController::class, 'changeStatus'])->name('users.changeStatus');
    Route::get('Categories/status/{id}', [CategoryController::class, 'changeStatus'])->name('categories.changeStatus');
    Route::get('posts/status/{id}', [PostController::class, 'changeStatus'])->name('posts.changeStatus');
    Route::get('posts/comment/delete/{id}', [PostController::class, 'deleteComment'])->name('posts.deleteComment');
    Route::get('admins/status/{id}', [AdminController::class, 'changeStatus'])->name('admins.changeStatus');
    Route::post('posts/image/delete/{image_id}', [PostController::class, 'deletePostImage'])->name('posts.image.delete');


    Route::controller(SettingController::class)->prefix('settings')->name('settings.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'update')->name('update');
    });

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'update')->name('update');
    });
    Route::controller(ContactController::class)->prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });

    Route::controller(NotificationController::class)->prefix('notification')->name('notification.')->group(function () {
        Route::get('/','index' )->name('index');
        Route::post('/delete','delete')->name('delete');
        Route::get('/delete-all','deleteAll')->name('deleteAll');


    });
});
