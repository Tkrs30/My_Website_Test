<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use Request;

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
        $locale = Request::header('accept-language', App::getLocale());
        App::setLocale(substr($locale, 0, 2));
    }
}
