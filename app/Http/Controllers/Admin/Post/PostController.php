<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Category;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('can:posts');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->sort_by ?? 'id';
        $order_by = request()->order_by ?? 'desc';
        $limit_by = request()->limit_by ?? 5;


        $posts = Post::when(request()->Keyword, function ($q) {
            $q->where('title', 'LIKE', '%' . request()->Keyword . '%');
        })->when(!is_null(request()->status), function ($q) {
            $q->where('status', request()->status);
        });

        $posts = $posts->orderBy($sort_by, $order_by)->paginate($limit_by);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::activeCat()->select('id','name')->get();
        return view('admin.posts.create',['categories'=>$categories]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();

    try{
        DB::beginTransaction();

        $post =Auth::guard('admin')->user()->posts()->create($request->except(['_token', 'images']));
   
        ImageManger::uploadImages($request,$post);


        DB::commit();
        Cache::forget('read_more_posts');
        Cache::forget('latest_posts');


    }catch(\Exception $e){
        DB::rollBack();
        return redirect()->back()->withErrors(['errors',$e->getMessage()]);  

    }


    
     Session::flash('success','You Register successfully');
     return redirect()->back();  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('comments')->findOrFail($id);
        return view('admin.posts.show',compact(['post'])) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post =Post::findOrFail($id);
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $request->validated();
        try{
          DB::beginTransaction();
    
          $post =Post::findOrFail($id);
          $post->update($request->except(['_token', 'images']));
      
          if($request->hasFile('images')){
      
            ImageManger::deleteImages($post);
            ImageManger::uploadImages($request,$post);
      
          }
          DB::commit();
    
      }catch(\Exception $e){
          DB::rollBack();
          return redirect()->back()->withErrors(['erorrs',$e->getMessage()]);  
    
      }
     
        Session::flash('success','Post Updated successfully');
        return redirect()->route('admin.posts.index'); 
    
    }
    public function changeStatus($id)
    {

        $post = Post::findOrFail($id);

        if ($post->status == 1) {
            $post->update([
                'status' => 0
            ]);
            Session::flash('success', 'Post Blocked Successfully');
        } else {
            $post->update([
                'status' => 1
            ]);
            Session::flash('success', 'Post Active Successfully');
        }
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        ImageManger::deleteImages($post);
        $post->delete();
        Session::flash('success', 'post deleted successfully');
        return redirect()->route('admin.posts.index');
    }
    
    public function deletePostImage(Request $request , $image_id){
        $image = Image::find($request->key);
        if(!$image){
          return response()->json([
            'status'=>'201',
            'msg'=>'Image Not Found'
          ]);
        }
        ImageManger::deleteImageFormLocal($image->path);
    
        $image->delete();
        return response()->json([
          'status'=>'201',
          'msg'=>'Image deleted successfully'
        ]);
    
      }
    
      public function deleteComment($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Session::flash('success','Comment Deleted Successfully');
        return redirect()->back();
      }
 
}
