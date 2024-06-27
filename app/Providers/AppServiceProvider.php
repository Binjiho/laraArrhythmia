<?php

namespace App\Providers;

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
        $debugIp = [
            '218.235.94.247',
            '218.235.94.217',
            '218.235.94.246',
            '218.235.94.223',
        ];

        if (array_search(request()->ip(), $debugIp) !== false) {
            config(['app.env' => 'local']);
            config(['app.debug' => true]);
            config(['debugbar.enabled' => true]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
