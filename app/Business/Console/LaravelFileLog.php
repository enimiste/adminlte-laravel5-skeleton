<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 16/12/16
 * Time: 11:14
 */

namespace App\Business\Console;


use Illuminate\Console\Command;
use Illuminate\Log\Writer;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Illuminate\Contracts\Logging\Log as LogContract;

class LaravelFileLog implements LogContract, PsrLoggerInterface
{
    /**
     * @var LogContract
     */
    protected $writer;
    /**
     * @var LogContract
     */
    private $log;


    /**
     * ConsoleAndLogWriter constructor.
     * @param Writer $writer
     * @param LogContract $log
     */
    public function __construct(Writer $writer, LogContract $log)
    {
        $this->writer = $writer;
        $this->log = $log;
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
        $this->writer->alert($message, $context);
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
        $this->writer->critical($message, $context);
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
        $this->writer->error($message, $context);
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
        $this->writer->warning($message, $context);
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
        $this->writer->notice($message, $context);
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
        $this->writer->info($message, $context);
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
        $this->writer->debug($message, $context);
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
        $this->writer->log($level, $message, $context);
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
        $this->writer->useFiles($path, $level);
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
        $this->writer->useDailyFiles($path, $days, $level);
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
        $this->writer->emergency($message, $context);
        $this->log->critical($message, $context);
    }
}