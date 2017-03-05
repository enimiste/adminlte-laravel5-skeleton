<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 25/11/16
 * Time: 18:02
 */

namespace App\Business\Exception;


use Exception;

class ContainerException extends BusinessException
{
    /**
     * BusinessException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     * @param array $errors
     */
    public function __construct($message = "", $code = 0, Exception $previous = null, array $errors = [])
    {
        parent::__construct($message, $code, $previous, $errors);
    }

}