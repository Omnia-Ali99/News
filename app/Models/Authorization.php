<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    use HasFactory;
    protected $fillable =['role','premessions','created_at','updated_at'];
    
    public function getpremessionsAttribute($premessions)
{
   return json_decode($premessions);
}
public function admins(){
    return $this->hasMany(Admin::class ,'role_id');
}
}
