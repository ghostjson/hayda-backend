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
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/common_routes.php'));

            Route::prefix('api/auth')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/auth_routes.php'));

            Route::prefix('api/blog')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/blog_routes.php'));

            Route::prefix('api/health-hub')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/health_hub_routes.php'));

            Route::prefix('api/pages')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/page_editor_routes.php'));

            Route::prefix('api/subscriptions')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/subscriptions_routes.php'));

            Route::prefix('api/settings')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/settings_routes.php'));

            Route::prefix('api/payment')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/payment_routes.php'));
//            Route::middleware('web')
//                ->namespace($this->namespace)
//                ->group(base_path('routes/web.php'));

            Route::prefix('api/chat')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/chat_routes.php'));

            Route::prefix('api/goals')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/goals_routes.php'));

            Route::prefix('api/goals/nutrition')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/nutrition_goals_routes.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
