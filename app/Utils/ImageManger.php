<?php
Namespace App\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ImageManger{
     
    public static function uploadImages($request ,$post){

        if($request->hasFile('images')){
   
            foreach($request->images as $image){
    
                $file = Str::uuid() .time(). $image->getClientOriginalExtension();
    
                $path = $image->storeAs('uploads/posts',$file,['disk'=>'uploads']);
                
    
                $post->images()->create([
                    'path' => $path
                ]);
        
            } 
    }

}

public static function deleteImages($post){

    if($post->images->count()>0){
        foreach($post->images as $image){
          if(File::exists(public_path($image->path))){
            File::delete(public_path($image->path));
   
          }
        }
   
      }

}
}