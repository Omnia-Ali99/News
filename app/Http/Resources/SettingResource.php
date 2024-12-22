<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'site_name' => $this->site_name,
            'email' => $this->email,
            'favicon' => $this->favicon,
            'logo' => asset($this->logo),
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'phone' => $this->phone,
            'address'=>$this->street . ',' .  $this->city . ',' . $this->country,
        
            'small_desc' =>$this->small_desc,
        ];
    }
}
