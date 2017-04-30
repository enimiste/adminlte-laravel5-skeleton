<?php

namespace App\Providers;

use App\Business\Exception\ContainerException;
use App\Menu\MyListRendrer;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use App\View\Composer\MenuComposer;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Business\Contracts\TokenGeneratorInterface;
use App\Business\Generators\RamseyUuidTokenGenerator;
use Org\Asso\Business\Validators\FakeEmailChecker;
use Org\Asso\Business\Validators\FakeEmailCheckerInterface;
use Org\Asso\ModelSerializer\Formatters\DateFormatter;
use Org\Asso\ModelSerializer\Formatters\DateTimeFormatter;
use Org\Asso\ModelSerializer\Formatters\DecimalFormatter;


class AppServiceProvider extends ServiceProvider
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
        | For dev environment only
        |--------------------------------------------------------------------------
        |
        */
        if (app()->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

        /*
        |--------------------------------------------------------------------------
        | View composers
        |--------------------------------------------------------------------------
        |
        */
        \View::composer('*', MenuComposer::class);

        /*
        |--------------------------------------------------------------------------
        | Console commands
        |--------------------------------------------------------------------------
        |
        |
        */
        //$this->app->bind(GenerateLarouteJsFile::class, function () {
        //    $cmd = new GenerateLarouteJsFile();
        //    $cmd->setLogger(new LaravelFileLog(app(Writer::class), new ConsoleLog($cmd, new NullConsoleLog())));
        //    return $cmd;
        //});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
		|--------------------------------------------------------------------------
		| Artisan|Web indicator
		|--------------------------------------------------------------------------
		| Check if artisan.php and public/index.php files
        | defines the "running_from_artisan" boolean binding
        | in the container
		|
		*/
        if (!$this->app->bound('running_from_artisan'))
            throw new ContainerException('You should bind "running_from_artisan" boolean into the container in the files artisan.php and public/index.php');


        /*
		|--------------------------------------------------------------------------
		| Localisation
		|--------------------------------------------------------------------------
		|
		|
		*/
        Carbon::setLocale(config('app.locale'));//Localised dates for Carbon
        setlocale(LC_ALL, config('app.locale_long'));//Localised dates for php


        /*
        |--------------------------------------------------------------------------
        | Authentication
        |--------------------------------------------------------------------------
        |
        */
        $this->app->bind('authenticated_user_email', function () {
            $u = $this->app->make(Authenticatable::class);
            if (!is_null($u)) return $u->email;
            else {
                if ($this->app->make('running_from_artisan'))
                    return 'SYSTEM';
                else return 'NOT_AUTHENTICATED';
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Formatters
        |--------------------------------------------------------------------------
        |
        */
        $this->app->bind(DateFormatter::class, function () {
            $dateFormatter = new DateFormatter();
            $dateFormatter->setFormat(config('common.date_format'));
            return $dateFormatter;
        });

        $this->app->bind(DateTimeFormatter::class, function () {
            $dateTimeFormatter = new DateTimeFormatter();
            $dateTimeFormatter->setFormat(config('common.date_time_format'));
            return $dateTimeFormatter;
        });

        $this->app->bind(DecimalFormatter::class, function () {
            $decimalFormetter = new DecimalFormatter();
            $decimalFormetter->setPrecision(2);
            return $decimalFormetter;
        });

        /*
        |--------------------------------------------------------------------------
        | Data checkers
        |--------------------------------------------------------------------------
        |
        */
        $this->app->singleton(FakeEmailCheckerInterface::class, function () {
            return new FakeEmailChecker([]);
        });

        /*
        |--------------------------------------------------------------------------
        | Generators
        |--------------------------------------------------------------------------
        |
        |
        */
        $this->app->singleton(TokenGeneratorInterface::class, RamseyUuidTokenGenerator::class);

        /*
        |--------------------------------------------------------------------------
        | Storage Connection
        |--------------------------------------------------------------------------
        |
        |
        */


        /*
        |--------------------------------------------------------------------------
        | Business Services
        |--------------------------------------------------------------------------
        |
        |
        */


        /*
        |--------------------------------------------------------------------------
        | ETL
        |--------------------------------------------------------------------------
        |
        |
        */


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        |
        |
        */

        /*
        |--------------------------------------------------------------------------
        | Menu
        |--------------------------------------------------------------------------
        |
        |
        */
        $this->app->bind('knp_menu.renderer', function () {
            return new MyListRendrer(app('knp_menu.matcher'));
        });
        
    }
}
