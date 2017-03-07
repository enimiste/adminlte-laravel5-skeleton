<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 05/03/2017
 * Time: 23:18
 */

namespace App\Business\Constants;


use App\Business\Constants\Traits\ConstantsTrait;

class ImportedFileState implements ContantsInterface
{
    use ConstantsTrait;

    const IMPORTING = 'IMPORTING';
    const IMPORTED = 'IMPORTED';
    const PROCESSING = 'PROCESSING';
    const ERROR_PROCESSING = 'ERROR_PROCESSING';
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