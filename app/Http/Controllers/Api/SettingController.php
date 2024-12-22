<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\RelatedNewsSite;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getSettings(){

        $setting = Setting::first();

        if(!$setting){
            return apiResponse(404,'setting is empty' );
        }
        $data =[
            'related_sites' => $this->relatedSites(),
            'setting' => new SettingResource($setting),

        ];
        return apiResponse(200,'this is site setting',$data);
    }

    public function  relatedSites(){
        $related_sites = RelatedNewsSite::select('name','url')->get();
        if(!$related_sites){
            return apiResponse(404,'there are not related sites' );
        }
        return $related_sites;
    }
}
