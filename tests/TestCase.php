<?php

namespace Test;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->bind('running_from_artisan', function () {
            return true;
        });
        
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        
        return $app;
    }
}
