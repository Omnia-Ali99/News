<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';
    public const AdminHome = 'admin/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/admin.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {

        $this->configureRateLimiter();
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(20)->by($request->user()?->id ?: $request->ip())->response(function(){
                return apiResponse(429,'Try After Minute');
            });
        });

    }

    protected function configureRateLimiter(){

        RateLimiter::for('Contact', function (Request $request) {

            return Limit::perMinute(1)->by($request->ip())->response(function(){
                return apiResponse(429,'Try After Minute');
            });
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(2)->by($request->ip())->response(function () {
                return apiResponse(429, 'Try After Minute');
            });
        });
        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinute(2)->by($request->ip())->response(function () {
                return apiResponse(429, 'Try After Minute');
            });
        });
        RateLimiter::for('comments', function (Request $request) {
            return Limit::perMinute(1)->by($request->ip())->response(function () {
                return apiResponse(429, 'Try After Minute');
            });
        }); 
    }
}
