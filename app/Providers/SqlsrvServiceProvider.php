<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\SqlsrvDataHelper;

class SqlsrvServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('SqlsrvDataHelper', function ($app) {
            return new SqlsrvGetData($app);
        });
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
