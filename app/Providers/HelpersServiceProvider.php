<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/LabelHelper.php';
        require_once app_path() . '/Helpers/DatetimeHelper.php';
        require_once app_path() . '/Helpers/RALHelper.php';
    }
}
