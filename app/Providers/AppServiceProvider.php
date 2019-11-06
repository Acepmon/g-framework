<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use App\Content;
use App\ContentMeta;
use App\UserMeta;
use App\Observers\ContentObserver;
use App\Observers\ContentMetaObserver;
use App\Observers\UserMetaObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Content::observe(ContentObserver::class);
        ContentMeta::observe(ContentMetaObserver::class);
        UserMeta::observe(UserMetaObserver::class);

        Blade::extend(function($value) {
            return preg_replace('/\{\?(.+)\?\}/', '<?php ${1} ?>', $value);
        });



    }
}
