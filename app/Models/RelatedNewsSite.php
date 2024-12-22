<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedNewsSite extends Model
{
    use HasFactory;
    protected $table = 'related_sites';
    protected $fillable =['name','url','created_at','updated_at'];

    public static function fillterRequest(){
        return [
            'name'=>['required','string','max:40'],
            'url'=>['required','url']
        ];
    }
}
