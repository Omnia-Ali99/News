<?php
Namespace App\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ImageManger{
     
    public static function uploadImages($request,$post=null,$user=null){

        if($request->hasFile('images')){
   
            foreach($request->images as $image){
    
                $file = self::generateImageName($image);

                $path = self::storeImageInlocal($image,'posts', $file);
    
                
    
                $post->images()->create([
                    'path' => $path
                ]);
        
            } 
    }

    if($request->hasFile('image')){

      $image = $request->file('image');

      self::deleteImageFormLocal($user->image);

      $file = self::generateImageName($image);
      $path =self::storeImageInlocal($image,'users', $file);


      $user->update(['image'=>$path]);

  }

}

public static function deleteImages($post){

    if($post->images->count()>0){
        foreach($post->images as $image){

          self::deleteImageFormLocal($image->path);
          $image->delete();
         
        }
      }
    }

 private static function generateImageName($image){

  $file = Str::uuid() .time(). $image->getClientOriginalExtension();
  return $file;

}
 private static function storeImageInlocal($image, $path, $file_name,){

  $path = $image->storeAs('uploads/'.$path , $file_name , ['disk'=>'uploads']);
  return  $path;

}

public static function deleteImageFormLocal($image_path){

  if(File::exists(public_path($image_path))){
    File::delete(public_path($image_path));

  }

}
}