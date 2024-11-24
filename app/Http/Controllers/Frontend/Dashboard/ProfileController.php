<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Models\Post;
use App\Models\Comment;
use App\Utils\ImageManger;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
  public function index(){

    $posts = auth()->user()->posts()->active()->with(['images'])->latest()->get();
    return view('frontend.dashboard.profile',compact('posts'));

  }
  public function storePost(PostRequest $request ){

    try{
        DB::beginTransaction();

        $request->validated();
        $request->comment_able == 'on' ? $request->merge(['comment_able'=>1]) : $request->merge(['comment_able'=>0]);

        $post = auth()->user()->posts()->create($request->except(['_token', 'images']));
   
        ImageManger::uploadImages($request,$post);


        DB::commit();
        Cache::forget('read_more_posts');
        Cache::forget('latest_posts');


    }catch(\Exception $e){
        DB::rollBack();
        return redirect()->back()->withErrors(['erorrs',$e->getMessage()]);  

    }


    
     Session::flash('success','You Register successfully');
     return redirect()->back();  

  }

  public function editPost($slug){
  return $slug;
  }
  public function deletePost(Request $request){

    $post = Post::where('slug' ,$request->slug)->first();
     
    if(!$post){
           abort(404);
    }
    ImageManger::deleteImages($post);

  
   $post->delete();
   return redirect()->back()->with('success','Post Deleted Successfully');  
  }
  public function getComments($id)
  {
      $comments = Comment::with(['user'])->where('post_id', $id)->get();
      if (!$comments) {
          return response()->json([
              'data' => null,
              'msg' => 'No Comments',
          ]);
      }
      return response()->json([
          'data' => $comments,
          'msg' => 'Contain Comments',
      ]);
  }
}
