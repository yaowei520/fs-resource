<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @param Request $request
     * @return void
     */
    public function map(Request $request)
    {
        // url: http://local.com/cn    获取cn
        $locale = $request->segment(1);
        $this->app->setLocale($locale);
        $this->mapApiRoutes($locale);

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @param $locale
     * @return void
     */
    protected function mapApiRoutes($locale)
    {
        $group = [
            'middleware' => 'api',
            'prefix' => 'api',
            'namespace' => $this->namespace
        ];
        if (array_key_exists($locale, $this->app->config->get('app.locales'))) {
            $group['prefix'] = $locale . '/api';
        }
        Route::group($group,function (){
           require base_path('routes/api.php');
        });

        //框架自带写法
//        Route::prefix('api')
//             ->middleware('api')
//             ->namespace($this->namespace)
//             ->group(base_path('routes/api.php'));

    }
}
