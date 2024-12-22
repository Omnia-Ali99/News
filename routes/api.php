<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\Generalcontroller;
use App\Http\Controllers\Api\SettingController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('posts/{keyword?}',[Generalcontroller::class,'getPosts']);
Route::get('post/show/{slug}',[Generalcontroller::class,'showPost']);
Route::get('post/comments/{slug}',[Generalcontroller::class,'getPostComments']);

Route::get('categories',[CategoryController::class,'getCategories']);
Route::get('category/{slug}/posts',[CategoryController::class,'getCategoryPosts']);

Route::post('contacts/store',[ContactController::class,'storeContact']);


Route::get('settings',[SettingController::class,'getSettings']);
