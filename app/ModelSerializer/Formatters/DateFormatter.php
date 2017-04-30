<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 28/12/2016
 * Time: 14:44
 */

namespace Org\Asso\ModelSerializer\Formatters;


use Org\Asso\Assert\Assert;
use Org\Asso\Business\Contracts\Serialization\Formatter\FormatterInterface;
use Org\Asso\Business\Exception\BusinessException;

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
        Assert::string($format);
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