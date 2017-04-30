<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 31/01/2016
 * Time: 22:16
 */

namespace App\Business\Contracts\Serialization;


use Illuminate\Database\Eloquent\Model;

interface SerializerInterface
{

    /**
     * @param Model $model
     *
     * @return array
     */
    function serialize($model);

    /**
     * Set if this serializer will be used for many items to list
     *
     * @param bool $isForList
     */
    function setIsForList($isForList);
}