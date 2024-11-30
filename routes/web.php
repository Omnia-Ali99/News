<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\Dashboard\NotificationController;
use App\Http\Controllers\Frontend\Dashboard\ProfileController;
use App\Http\Controllers\Frontend\Dashboard\SettingController;
use App\Http\Controllers\Frontend\NewsSubscriberController;

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
Route::redirect('/','/home');

Route::group([
'as'=>'frontend.'
],function(){
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::post('news-subscribe',[NewsSubscriberController::class,'store'])->name('news.subscribe');
    Route::get('category/{slug}',CategoryController::class)->name('category.posts');
   
    Route::controller(PostController::class)->name('post.')->prefix('post/')->group(function(){
        Route::get('{slug}','show')->name('show');
        Route::get('comments/{slug}','getAllPosts')->name('getAllComments');
        Route::post('comments/store','saveComment')->name('comments.store');

    });

    Route::controller(ContactController::class)->name('contact.')->prefix('contact-us')->group(function(){
        Route::get('contact-us',[ContactController::class,'index'])->name('index');
        Route::post('contact-us/store',[ContactController::class,'store'])->name('store');
    
    });
   Route::match(['get', 'post'],'search',SearchController::class)->name('search');

   Route::prefix('account/')->name('dashboard.')->middleware(['auth:web'])->group(function(){

    Route::controller(ProfileController::class)->group(function(){
        Route::get('profile','index')->name('profile');
        Route::post('post/store','storePost')->name('post.store');
        Route::delete('post/delete','deletePost')->name('post.delete');
        Route::get('post/get-comments/{id}','getComments')->name('post.getComments');
        Route::get('post/{slug}/edit',action: 'showEditForm')->name('post.edit');
        Route::put('post/update','update')->name('post.update');
        Route::post('post/image/delete/{image_id}' , 'deletePostImage')->name('post.image.delete');

    });

    Route::prefix('setting')->controller(SettingController::class)->group(function(){
        Route::get('/','index')->name('setting');
        Route::post('/update','update')->name('setting.update');
        Route::post('/change-password','ChangePassword')->name('setting.ChangePassword');
        
    });

    Route::prefix('notification')->controller(NotificationController::class)->group(function(){
        Route::get('/','index')->name('notification.index');
        Route::post('/delete','delete')->name('notification.delete');
        Route::get('/delete-all','deleteAll')->name('notification.deleteAll');

    });


   });

});



Route::prefix('email')->name('verification.')->controller(VerificationController::class)->group(function(){
    Route::get('/verify', 'show')->name('notice');
    Route::get('/verify/{id}/{hash}','verify')->name('verify');
    Route::post('/resend','resend')->name('resend');
  
});
  
Auth::routes();

