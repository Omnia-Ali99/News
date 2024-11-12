<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $filable=['id','comment','ip_address','status','user_id','post_id','created_at','updated_at'];
 
    public function post(){
        return $this->belongsTo(Post::class ,'post_id');

    }
}
