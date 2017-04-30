<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 28/12/2016
 * Time: 14:44
 */

namespace App\ModelSerializer\Formatters;



use App\Business\Assert\AssertThat;
use App\Business\Contracts\Serialization\Formatter\FormatterInterface;
use App\Business\Exception\BusinessException;

class DateFormatter implements FormatterInterface
{
    /** @var  string */
    protected $format;

    /**
     * @param string $format
     * @throws BusinessException
     */
    public function setFormat($format = 'd-m-Y')
    {
        AssertThat::string($format);
        $this->format = $format;
    }

    /**
     * Format a value to a string, int or float
     *
     * @param string|int|float $value
     *
     * @return string|int|float
     */
    function format($value)
    {
        return $value instanceof \DateTime ? $value->format($this->format) : '';
    }
}