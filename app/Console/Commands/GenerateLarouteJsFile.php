<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateLarouteJsFile extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laroute:delete-re-generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete existing laroute file and generate a new one';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = public_path('js/laroute.js');
        if (file_exists($file)) {
            @unlink($file);
            $this->logger->info($file . ' deleted');
        }
        $this->call('laroute:generate');
    }
}
