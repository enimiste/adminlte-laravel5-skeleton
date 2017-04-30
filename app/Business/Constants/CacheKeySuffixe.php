<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 08/03/2017
 * Time: 16:21
 */

namespace App\Business\Constants;


use App\Business\Constants\Traits\ConstantsTrait;

class CacheKeySuffixe implements ConstantsInterface
{
    use ConstantsTrait;

    const CONSOLE_LOG = '-console_log';
    const STATE_LOG = '-state_log';

    /**
     * Classes implementing this interface should define only public constants
     * that represents states for objects
     *
     * @return void
     */
    public function doc()
    {
    }
}