<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 22/02/17
 * Time: 18:46
 */

namespace App\Console\Commands;

use App\Business\Console\NullConsoleLog;
use Illuminate\Contracts\Logging\Log as LogContract;
use Illuminate\Console\Command;


abstract class BaseCommand extends Command
{

    /** @var  LogContract */
    protected $logger;

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->logger = app(NullConsoleLog::class);
    }

    /**
     * @param LogContract $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}