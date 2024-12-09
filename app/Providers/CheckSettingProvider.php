<?php

namespace App\Providers;


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
                'small_desc' => 'This is a default description.',
            ]);
        });

        $getSetting->whatsapp ="https://wa.me/".$getSetting->phone;
        view()->share([          
        'getSetting' => $getSetting, 
       
        ]);
    
    }
}
