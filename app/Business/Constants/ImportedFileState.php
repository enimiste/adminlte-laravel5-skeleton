<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 05/03/2017
 * Time: 23:18
 */

namespace App\Business\Constants;


use App\Business\Constants\Traits\ConstantsTrait;

class ImportedFileState implements ConstantsInterface
{
    use ConstantsTrait;

    const FROM_MIGRATION_ON_GC = 'FROM_MIGRATION_ON_GC';
    const IMPORTING = 'IMPORTING';
    const IMPORTED = 'IMPORTED';
    const WAITING_FOR_PROCESS = 'WAITING_FOR_PROCESS';
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
    }
}