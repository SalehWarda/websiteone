<?php

namespace App\Providers;

use App\Models\Backend\AboutUs;
use App\Models\Backend\SocialMedia;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        //
        Paginator::useBootstrap();
        view()->composer('partials.site.footer',function ($view){

            $view->with('socials',SocialMedia::get());
        });
        view()->composer('partials.site.footer',function ($view){

            $view->with('about',AboutUs::first());
        });

        view()->composer('layouts.app',function ($view){

            $view->with('about',AboutUs::first());
        });

        view()->composer('layouts.app',function ($view){

            $view->with('socials',SocialMedia::get());
        });
    }
}
