<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 10/03/2017
 * Time: 11:53
 */

namespace App\Business\Math;


class IntegerNumber extends \Enimiste\Math\VO\IntegerNumber
{

    /**
     * Format a given integer as float
     * toFormattedFloat(1230, 2, '.') ==> 12.30
     * toFormattedFloat(12, 2, '.') ==> 0.12
     *
     * @param int $amount
     * @param int $precision
     * @param string $decimalSeparator
     * @return string
     */
    public static function toFormattedFloat($amount, $precision = 2, $decimalSeparator = '.')
    {
        $s = '' . $amount;
        $s = str_pad($s, $precision + 1, '0', STR_PAD_LEFT);
        $sl = strlen($s);
        $l = substr($s, 0, $sl - 2);
        $r = substr($s, $sl - 2, $sl);

        return $l . $decimalSeparator . $r;
    }
}