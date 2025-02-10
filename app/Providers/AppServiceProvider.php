<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\News\NewsRepository::class,
            \App\Repositories\News\NewsRepository::class

        );

        $this->app->singleton(
            \App\Repositories\RedisPipeLine\RedisPipeLineRepository::class,
            \App\Repositories\RedisPipeLine\RedisPipeLineRepository::class

        );
        $this->app->singleton(
            \App\Repositories\Zone\ZoneRepository::class,
            \App\Repositories\Zone\ZoneRepository::class
        );

        Blade::directive('render', function ($component) {
            return "<?php echo (app($component))->toHtml(); ?>";
        });

        // $this->app->singleton('PJConstants', function() {
        //     return new Constants;
        // });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Use https links instead http links */
        if (Request::server('HTTP_X_FORWARDED_PROTO') == 'https')
        {
            URL::forceScheme('https');
        }
        Blade::componentNamespace('App\View\Components\Category', 'category');
        Blade::componentNamespace('App\View\Components\Detail', 'detail');
        Blade::componentNamespace('App\View\Components\Template', 'template');
        Blade::componentNamespace('App\View\Components\Home', 'home');
        Blade::componentNamespace('App\View\Components\Video', 'video');
        Blade::componentNamespace('App\View\Components\Layout', 'layout');

    }
}
