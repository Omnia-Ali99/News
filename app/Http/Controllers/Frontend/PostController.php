<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Flasher\Laravel\Http\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug){

        $mainPost = Post::active()->with(['comments'=>function($q){
            $q->latest()->limit(3);
        }])->whereSlug($slug)->first();
        $category =  $mainPost->category;
        $posts_belongs_to_category = $category->posts()->active()->select('id','title','slug')->limit(5)->get();

        $mainPost->increment('num_of_views');
        return view('frontend.show' ,compact('mainPost','posts_belongs_to_category'));


    }
    public function getAllPosts($slug){

        $post = Post::active()->whereSlug($slug)->first();
        $comments =$post->comments()->with('user')->get();
        return response()->json($comments);

    }
   
    public function saveComment(Request $request){

        $request->validate([
            'user_id'=>['required','exists:users,id'],
            'comment'=>['required','string','max:200'],
        ]);
       
        $comment = Comment::create([
            'user_id'=>$request->user_id,
            'comment'=>$request->comment,
            'post_id'=>$request->post_id,
            'ip_address'=>$request->ip(),
        ]);
     
       $comment->load('user');


      if(!$comment){
        return response()->json([
            'data'=>'operation failed',
            'status'=>403,
        ]);
    }
    return response()->json([
        'msg'=>'Comment Stored Successfully!',
        'comment'=>$comment,
        'status'=>201,
    ]);
    }
}
