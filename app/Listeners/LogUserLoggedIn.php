<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 30/04/17
 * Time: 20:53
 */

namespace App\Listeners;


use App\Business\Console\DbConsoleLog;
use App\Business\Constants\LoggableTypes;
use Illuminate\Auth\Events\Login;

class LogUserLoggedIn extends BaseListener
{

    /**
     * @var DbConsoleLog
     */
    private $consoleLog;

    public function __construct(DbConsoleLog $consoleLog)
    {

        $this->consoleLog = $consoleLog;
    }

    /**
     * @param Login $event
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        $this->consoleLog->info(sprintf('User %s logged in.', $user->email), [
            'loggable_type' => LoggableTypes::USER_MANAGEMENT,
            'loggable_id' => $user->getAuthIdentifier(),
        ]);
    }
}