<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NewCommentNotify;
use Flasher\Laravel\Http\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug){

        $mainPost = Post::active()->with(['comments'=>function($q){
            $q->latest()->limit(3);
        }])->whereSlug($slug)->first();
        
        if (!$mainPost) {
            abort(404, 'Post not found');
        }
        
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
   
    public function saveComment(CommentRequest $request){

     
        $comment = Comment::create([
            'user_id'=>$request->user_id,
            'comment'=>$request->comment,
            'post_id'=>$request->post_id,
            'ip_address'=>$request->ip(),
        ]);

        $post = Post::findOrFail($request->post_id);
        
        if(auth()->user()->id != $post->user_id){
            $post->user->notify(new NewCommentNotify($comment,$post));
        }
     
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
