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
        Setting::firstOr(function(){
            return Setting::create([
                'site_name'=>'news',
                'email'=>'news@gmail.com',
                'favicon'=>'default',
                'logo'=>'default',
                'facebook'=>'default',
                'twitter'=>'default',
                'instagram'=>'default',
                'youtube'=>'default',
                'phone'=>'01234678934',
                'country'=>'default country',
                'city'=>'default city',
                'street'=>'default street',
            ]);
        });
    }
}
