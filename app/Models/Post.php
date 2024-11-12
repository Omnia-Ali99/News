<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $filable=['id','title','slug','desc','comment_able','status','user_id','created_at','updated_at'];

    public function category(){
        $this->belongsTo(Category::class ,'category_id');
    }
    public function user(){
      return  $this->belongsTo(User::class ,'user_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class ,'post_id');
    }
    public function images(){
        return $this->hasMany(Image::class ,'post_id');
    }
}
