<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories(){
        $categories =Category::activeCat()->get();
        if(!$categories){
            return apiResponse(404,'Not Categories');
        }
        return apiResponse(200,'All Categories',new CategoryCollection($categories));
    }

    public function getCategoryPosts($slug){
        $category = Category::activeCat()->whereSlug($slug)->first();
        if(!$category){
            return apiResponse(404,'Category Not found');
        }
        $posts = $category->posts;
        return apiResponse(200,'This Is Category Posts', new PostCollection($posts));
    }
}
