<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 16/12/16
 * Time: 11:14
 */

namespace App\Business\Console;


use App\Business\Constants\CacheKeySuffixe;
use App\Models\ConsoleLog;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Logging\Log as LogContract;
use Illuminate\Database\Connection;
use Psr\Log\LoggerInterface as PsrLoggerInterface;

class DbConsoleLog implements LogContract, PsrLoggerInterface
{
    /**
     * @var Connection
     */
    private $db;
    /**
     * @var LogContract
     */
    private $log;

    /**
     * DbConsoleLog constructor.
     * @param Command $console
     * @param LogContract $log
     * @param Connection $db
     */
    public function __construct(LogContract $log, Connection $db)
    {
        $this->log = $log;
        $this->db = $db;
    }

    /**
     * Log an alert message to the logs.
     *
     * @param  string $message
     * @param  array $context
     * @return void
     */
    public function alert($message, array $context = [])
    {
        $this->insert('alert', $message, array_get($context, 'loggable_type', null), array_get($context, 'loggable_id', null));
        $this->log->alert($message, $context);
    }

    /**
     * Log a critical message to the logs.
     *
     * @param  string $message
     * @param  array $context
     * @return void
     */
    public function critical($message, array $context = [])
    {
        $this->insert('critical', $message, array_get($context, 'loggable_type', null), array_get($context, 'loggable_id', null));
        $this->log->critical($message, $context);
    }

    /**
     * Log an error message to the logs.
     *
     * @param  string $message
     * @param  array $context
     * @return void
     */
    public function error($message, array $context = [])
    {
        $this->insert('error', $message, array_get($context, 'loggable_type', null), array_get($context, 'loggable_id', null));
        $this->log->error($message, $context);
    }

    /**
     * Log a warning message to the logs.
     *
     * @param  string $message
     * @param  array $context
     * @return void
     */
    public function warning($message, array $context = [])
    {
        $this->insert('warning', $message, array_get($context, 'loggable_type', null), array_get($context, 'loggable_id', null));
        $this->log->warning($message, $context);
    }

    /**
     * Log a notice to the logs.
     *
     * @param  string $message
     * @param  array $context
     * @return void
     */
    public function notice($message, array $context = [])
    {
        $this->insert('notice', $message, array_get($context, 'loggable_type', null), array_get($context, 'loggable_id', null));
        $this->log->notice($message, $context);
    }

    /**
     * Log an informational message to the logs.
     *
     * @param  string $message
     * @param  array $context
     * @return void
     */
    public function info($message, array $context = [])
    {
        $this->insert('info', $message, array_get($context, 'loggable_type', null), array_get($context, 'loggable_id', null));
        $this->log->info($message, $context);
    }

    /**
     * Log a debug message to the logs.
     *
     * @param  string $message
     * @param  array $context
     * @return void
     */
    public function debug($message, array $context = [])
    {
        $this->insert('debug', $message, array_get($context, 'loggable_type', null), array_get($context, 'loggable_id', null));
        $this->log->debug($message, $context);
    }

    /**
     * Log a message to the logs.
     *
     * @param  string $level
     * @param  string $message
     * @param  array $context
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        $this->insert('log', $message, array_get($context, 'loggable_type', null), array_get($context, 'loggable_id', null));
        $this->log->log($level, $message, $context);
    }

    /**
     * Register a file log handler.
     *
     * @param  string $path
     * @param  string $level
     * @return void
     */
    public function useFiles($path, $level = 'debug')
    {
        $this->log->useFiles($path, $level);
    }

    /**
     * Register a daily file log handler.
     *
     * @param  string $path
     * @param  int $days
     * @param  string $level
     * @return void
     */
    public function useDailyFiles($path, $days = 0, $level = 'debug')
    {
        $this->log->useDailyFiles($path, $days, $level);
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        $this->insert('emergency', $message, array_get($context, 'loggable_type', null), array_get($context, 'loggable_id', null));
    }

    /**
     * @param $type
     * @param $message
     * @param string $loggable_type
     * @param string $loggable_id
     */
    public function insert($type, $message, $loggable_type = null, $loggable_id = null)
    {
        try {
            if ($loggable_id) \Cache::forget($loggable_id . CacheKeySuffixe::CONSOLE_LOG);

            /** @var ConsoleLog $e */
            $e = app(ConsoleLog::class);
            $e->type = $type;
            $e->message = $message;
            $e->loggable_type = $loggable_type;
            $e->loggable_id = $loggable_id;
            $e->save();
        } catch (\Exception $e) {
            //do nothing
        }
    }
}