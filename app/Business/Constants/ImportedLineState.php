<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 05/03/2017
 * Time: 23:18
 */

namespace App\Business\Constants;


use App\Business\Constants\Traits\ConstantsTrait;

class ImportedLineState implements ContantsInterface
{
    use ConstantsTrait;

    const IMPORTED = 'IMPORTED';
    const ERROR = 'ERROR';
    const PROCESSED = 'PROCESSED';

    /**
     * Classes implementing this interface should define only public constants
     * that represents states for objects
     *
     * @return void
     */
    public function doc()
    {
        // TODO: Implement doc() method.
    }
}