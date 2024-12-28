<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id'=>$this->id,
            'title' =>$this->title,
            'slug' =>$this->slug,
            'num_of_views' =>$this->num_of_views,
            'status'=>$this->status(),
            'data'=>$this->created_at->format('y-m-d h:m a'),
            'post_url'=>route('frontend.post.show',$this->slug),
            'publisher'=>$this->user_id == null ? new AdminResource($this->admin) : new UserResource($this->user),
            'media' =>ImageResource::collection($this->images),
            'category_name' =>$this->category->name,

        ];

        if($request->is('api/post/show/*')){

            $data['comment_able'] = $this->comment_able == 1 ? 'active' :'inactive';
            $data['small_desc']   = $this->small_desc;
            $data['category']     = new CategoryResource($this->category);
        }
        return $data;
    }
}
