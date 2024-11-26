<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LogViewer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        // $config = $this->app->get('config')->get('carbon.holidays');

        // if ($config instanceof Closure) {
        //     $config = $config($this->app);
        // }

        // if (is_array($config) && isset($config['region'])) {
        //     $classes = array_filter([
        //         'Carbon\Carbon',
        //         'Carbon\CarbonImmutable',
        //         'Illuminate\Support\Carbon',
        //     ], 'class_exists');

        //     // @codeCoverageIgnoreStart
        //     if (class_exists('Illuminate\Support\Facades\Date') &&
        //         (($now = Date::now()) instanceof DateTimeInterface) &&
        //         !in_array($class = get_class($now), $classes)) {
        //         $classes[] = $class;
        //     }
        //     // @codeCoverageIgnoreEnd

        //     BusinessDay::enable($classes, $config);
        // }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        LogViewer::auth(function ($request) {
            // dd($request->user()->roles());
            // $request->user()
            // && in_array($request->user()->role(), [
            //     'john@example.com',
            // ]);
            return true;
        });

    }
}
