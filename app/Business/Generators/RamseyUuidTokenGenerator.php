<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 05/03/2017
 * Time: 23:41
 */

namespace App\Business\Generators;


use App\Business\Contracts\TokenGeneratorInterface;
use Ramsey\Uuid\Uuid;

class RamseyUuidTokenGenerator implements TokenGeneratorInterface
{

    /**
     * Return the next unique token
     *
     * @return string
     */
    function nextToken(array $extras = [])
    {
        if (array_key_exists('ns', $extras) && array_key_exists('name', $extras))
            return Uuid::uuid5($extras['ns'], $extras['name'])->toString();
        else
            return Uuid::uuid4()->toString();
    }
}