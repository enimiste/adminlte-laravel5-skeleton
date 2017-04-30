<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 28/12/2016
 * Time: 14:38
 */

namespace App\ModelSerializer\Formatters;


use App\Business\Assert\AssertThat;
use App\Business\Contracts\Serialization\Formatter\FormatterInterface;
use App\Business\Exception\BusinessException;
use Enimiste\Math\VO\Number;

class DecimalFormatter implements FormatterInterface
{

    /** @var  integer */
    protected $precision;

    /**
     * @param int $precision
     * @throws BusinessException
     */
    public function setPrecision($precision = 2)
    {
        AssertThat::integer($precision);
        AssertThat::greaterThanEq($precision, 0);
        $this->precision = $precision;
    }

    /**
     * Format a value to a string, int or float
     *
     * @param string|int|float|Number $value
     *
     * @return string|int|float
     */
    function format($value)
    {
        if($value instanceof Number)
            $value = $value->getValue();

        return number_format($value, $this->precision, '.', '');
    }
}