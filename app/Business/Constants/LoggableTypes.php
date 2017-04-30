<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 07/03/2017
 * Time: 14:36
 */

namespace App\Business\Constants;


use App\Business\Constants\Traits\ConstantsTrait;

class LoggableTypes implements ConstantsInterface
{
    use ConstantsTrait;

	const USER_MANAGEMENT = 'USER_MANAGEMENT';
    //TODO

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