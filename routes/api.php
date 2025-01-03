<?php

use App\Http\Controllers\Api\Account\NotificationController;
use App\Http\Controllers\Api\Account\PostController;
use App\Http\Controllers\Api\Account\SettingController as AccountSettingController;
use App\Http\Controllers\Api\Auth\loginController;
use App\Http\Controllers\Api\Auth\Password\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\Generalcontroller;
use App\Http\Controllers\Api\RelatedNewsController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Resources\UserResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('auth/register', [RegisterController::class, 'register'])->middleware('throttle:register');

Route::controller(loginController::class)->middleware('throttle:login')->group(function () {
    Route::post('auth/login', 'login');
    Route::delete('auth/logout', 'logout')->middleware('auth:sanctum');
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::post('password/email', 'sendOtp');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::post('password/reset', 'resetPassword');
});


Route::controller(VerifyEmailController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('auth/verify/email', 'verifyEmail');
    Route::get('auth/verify/send-again', 'sendOtpAgain');
});


Route::middleware(['auth:sanctum','CheckUserStatus','verifyEmail'])->prefix('account')->group(function(){
    Route::get('user',function(){
        return UserResource::Make(auth()->user());
    });
    Route::put('setting/{user_id}',[AccountSettingController::class,'updateSetting']);
    Route::put('password/{user_id}',[AccountSettingController::class,'updatePassword']);

    Route::controller(PostController::class)->prefix('posts')->group(function(){
        Route::get('/','getUserPosts');
        Route::post('/store','storeUserPost');
        Route::delete('/destroy/{post_id}','destroyUserPost');
        Route::put('/update/{post_id}','updateUserPost');

        Route::get('/{post_id}/comments','getPostComments');
        Route::post('/comments/store','storeComment')->middleware('throttle:comments');
    });

    Route::get('notifications',[NotificationController::class,'getNotifications']);
    Route::get('notifications/read/{id}',[NotificationController::class,'readNotifications']);


});


Route::controller(Generalcontroller::class)->group(function () {
    Route::get('posts/{keyword?}', 'getPosts');
    Route::get('post/show/{slug}', 'showPost');
    Route::get('post/comments/{slug}', 'getPostComments');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('categories', 'getCategories');
    Route::get('category/{slug}/posts', 'getCategoryPosts');
});

Route::post('contacts/store', [ContactController::class, 'storeContact'])->middleware('throttle:Contact');


Route::get('settings', [SettingController::class, 'getSettings']);

Route::get('related-sites', RelatedNewsController::class);
