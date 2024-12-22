<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'category_name'=>$this->name,
            'category_slug'=>$this->slug,
            'ststus'=>$this->status(),
            'created_date'=>$this->created_at->format('y-m-d'),

        ];
        if(! $request->is('api/post/show/*')){
           $data['posts']=PostResource::collection($this->posts);
        }
        return $data;

    }
}