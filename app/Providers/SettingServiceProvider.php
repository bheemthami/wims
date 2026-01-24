<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'welcome',
            'layouts.admin.app',
            'layouts.admin.head',
            'admin.home',
            'auth.login',
            'admin.school.individual.index',
            'layouts.admin.sidebar',
            'layouts.frontend.head',
            'layouts.frontend.header',
            'layouts.frontend.footer',
        ], 'App\Http\ViewComposers\SettingComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
