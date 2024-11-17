<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\RelatedNewsSite;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
      $getSetting =  Setting::firstOr(function(){
            return Setting::create([
                'site_name'=>'news',
                'email'=>'news@gmail.com',
                'favicon'=>'default',
                'logo'=>'/img/logo.png',
                'facebook'=>'https://www.facebook.com',
                'twitter'=>'https://www.twitter.com',
                'instagram'=>'https://www.instagram.com',
                'youtube'=>'https://www.youtube.com',
                'phone'=>'01234678934',
                'country'=>'Egypt',
                'city'=>'Alex',
                'street'=>'25 Tosson',
            ]);
        });

        //share related sites
         $relatedSites =RelatedNewsSite::select('name','url')->get();
          $categories=Category::select('slug','name')->get();
        view()->share([          
        'getSetting' => $getSetting, 
        'relatedSites'=>$relatedSites, 
        'categories'=>$categories,
        ]);
    
    }
}
