<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 05/03/2017
 * Time: 23:19
 */

namespace App\Business\Constants\Traits;


trait ConstantsTrait
{

    /**
     * @return array ['CONST']
     */
    public function asArray()
    {
        $ref = new \ReflectionObject($this);
        return $ref->getConstants();
    }

    /**
     * @return array ['CONST' => 'CONST']
     */
    public function toAssocArray()
    {
        $cst = $this->asArray();
        return array_combine($cst, $cst);
    }

    /**
     * Check whither the $const is a valid value
     *
     * @return bool
     */
    public function isValid($const)
    {
        return in_array($const, $this->asArray());
    }
}