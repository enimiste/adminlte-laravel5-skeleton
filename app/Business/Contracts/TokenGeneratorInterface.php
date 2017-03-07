<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 05/03/2017
 * Time: 23:38
 */

namespace App\Business\Contracts;


interface TokenGeneratorInterface
{
    /**
     * Return the next unique token
     *
     * @return string
     */
    function nextToken(array $extras = []);
}