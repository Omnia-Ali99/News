<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Category;
use App\Models\RelatedNewsSite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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

        if (!Schema::hasTable('related_sites')) {

            Log::error('The related_sites table is not available.');
            return;
        }

        if (!Schema::hasTable('categories')) {
          
             Log::error('The categories table is not available.');
            return;
        }
        //share related sites
        $relatedSites = RelatedNewsSite::select('name', 'url')->get();
        $categories = Category::activeCat()->select('id', 'slug', 'name')->get();



        view()->share([
            'relatedSites' => $relatedSites,
            'categories' => $categories,


        ]);
    }
}
