<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 05/03/2017
 * Time: 07:42
 */

namespace App\Console\Commands;

use Illuminate\Console\Application;
use Illuminate\Container\Container;

class DebugContainer extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'container:debug';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show all bindings in the container (alias and tags not included)';
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
        $container = $this->getContainer();
        $bindings = $container->getBindings();
        $this->output->note(count($bindings) . ' bindings founded');
        $headers = ['Key', 'shared'];
        $rows = [];
        foreach ($bindings as $key => $meta) {
            $shared = $meta['shared'];
            $rows[] = [$key, $shared ? 'Shared' : ''];
        }
        uasort($rows,
            function (array $a, array $b) {
                return strcmp($a[0], $b[0]);
            });
        $this->table($headers, $rows);
    }
    /**
     * @return Container
     */
    private function getContainer()
    {
        /** @var Application $app */
        $app = $this->getApplication();
        return $app->getLaravel();
    }
}