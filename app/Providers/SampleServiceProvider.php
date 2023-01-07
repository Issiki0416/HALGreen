<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SampleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('serviceProviderTest', function () {
            return 'サービスプロバイダーテスト';
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
