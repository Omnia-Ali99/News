<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $posts = Post::with('images')->paginate(9);
        return view('frontend.index' ,compact('posts'));
    }
}
