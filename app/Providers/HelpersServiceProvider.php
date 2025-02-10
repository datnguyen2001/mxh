<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      require_once app_path() . '/Helpers/UserInterfaceHelper.php';
      require_once app_path() . '/Helpers/RedisClientHelper.php';
      require_once app_path() . '/Helpers/MemcachedHelpers.php';
      require_once app_path() . '/Helpers/ElasticsearchHelpers.php';
      require_once app_path() . '/Helpers/FormatHelpers.php';

//        $this->app->singleton('Helpers', function ($app) {
//            return new Helpers($app);
//        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
