<?php

use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ContactController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscriberController;
use App\Http\Controllers\Frontend\PostController;

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

Route::group([
'as'=>'frontend.'
],function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::post('news-subscribe',[NewsSubscriberController::class,'store'])->name('news.subscribe');
    Route::get('category/{slug}',CategoryController::class)->name('category.posts');
    Route::get('post/{slug}',[PostController::class,'show'])->name('post.show');
    Route::get('post/comments/{slug}',[PostController::class,'getAllPosts'])->name('post.getAllComments');
    Route::post('post/comments/store',[PostController::class,'saveComment'])->name('post.comments.store');
    Route::get('contact-us',[ContactController::class,'index'])->name('contact.index');
    Route::post('contact/store',[ContactController::class,'store'])->name('contact.store');


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
