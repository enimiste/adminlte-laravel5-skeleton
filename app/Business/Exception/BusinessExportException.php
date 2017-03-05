<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 25/11/16
 * Time: 18:02
 */

namespace App\Business\Exception;


use Exception;

class BusinessExportException extends BusinessException
{
    /**
     * @var array
     */
    private $filters;

    /**
     * BusinessExportException constructor.
     * @param array $filters [$column, $op, $value]
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     * @param array $errors
     */
    public function __construct(array $filters, $message = "", $code = 0, Exception $previous = null, array $errors = [])
    {
        parent::__construct($message, $code, $previous, $errors);
        $this->filters = $filters;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }


}