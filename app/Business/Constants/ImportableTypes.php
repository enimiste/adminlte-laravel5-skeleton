<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 07/03/2017
 * Time: 14:36
 */

namespace App\Business\Constants;


use App\Business\Constants\Traits\ConstantsTrait;

class ImportableTypes implements ContantsInterface
{
    use ConstantsTrait;

    const CLIENT_FILES = 'CLIENT_FILES';
    const PAIEMENT_FILES = 'PAIEMENT_FILES';

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