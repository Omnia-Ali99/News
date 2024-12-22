<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class Generalcontroller extends Controller
{
    public function getPosts()
    {

        $query = Post::query()->with(['user', 'category', 'admin', 'images'])->activeUser()->activeCategory()->active();

        $clonedQuery = clone $query;


        $all_posts = $clonedQuery->latest()->paginate(4);

        $latest_posts        =  $this->latestPoste(clone $query);
        $oldest_posts        =  $this->oldestPosts(clone $query);
        $popular_posts       =  $this->popularPosts(clone $query);
        $most_read_posts     =  $this->mostReadPosts(clone $query);
        $category_with_posts =  $this->catrgoryWithPosts();


        $data = [
            'all_posts'           => (new PostCollection($all_posts))->response()->getData(true),
            'latest_posts'        => new PostCollection($latest_posts),
            'oldest_posts'        => new PostCollection($oldest_posts),
            'popular_posts'       => new PostCollection($popular_posts),
            'category_with_posts' => new CategoryCollection($category_with_posts),
            'most_read_posts'     => new PostCollection($most_read_posts),
        ];

        return apiResponse(200, 'Success', $data);
    }

    public function latestPoste($query)
    {
        $latest_posts = $query->latest()->take(4)->get();
        if (!$latest_posts) {
            return apiResponse(404, 'posts not found');
        }
        return $latest_posts;
    }
    public function oldestPosts($query)
    {
        $oldest_posts = $query->oldest()->take(3)->get();
        if (!$oldest_posts) {
            return apiResponse(404, 'posts not found');
        }
        return $oldest_posts;
    }
    public function popularPosts($query)
    {
        $popular_posts = $query->withCount('comments')->orderBy('comments_count', 'desc')->take(3)->get();
        if (!$popular_posts) {
            return apiResponse(404, 'posts not found');
        }
        return $popular_posts;
    }

    public function catrgoryWithPosts()
    {
        $categories = Category::get();
        if (!$categories) {
            return apiResponse(404, 'categories not found');
        }
        $category_with_posts = $categories->map(function ($category) {
            $category->posts = $category->posts()->active()->take(4)->get();
            return $category;
        });
        if (!$category_with_posts) {
            return apiResponse(404, 'category with posts not found');
        }
        return $category_with_posts;
    }

    public function mostReadPosts($query)
    {
        $most_read_posts = $query->orderBy('num_of_views', 'desc')->take(3)->get();
        if (!$most_read_posts) {
            return apiResponse(404, 'posts not found');
        }
        return $most_read_posts;
    }


    public function showPost($slug)
    {
        $post = Post::with(['user', 'admin', 'category', 'images'])->active()->activeUser()->activeCategory()->whereSlug($slug)->first();

        if (!$post) {
            return apiResponse(404, 'post not found');
        }

        return apiResponse(200, 'this is post', PostResource::make($post));
    }
}
