<?php

namespace App\Providers;

use App\Models\ConsoleLog;
use Illuminate\Log\Writer;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        |--------------------------------------------------------------------------
        | Build business action loggers classes
        |--------------------------------------------------------------------------
        | To set the auth user
        |
        */
        $this->app->bind(ConsoleLog::class, function () {
            $e = new ConsoleLog();
            $e->by_user = app('authenticated_user_email');
            return $e;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
