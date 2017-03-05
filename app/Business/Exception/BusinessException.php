<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 25/11/16
 * Time: 18:02
 */

namespace App\Business\Exception;


use Exception;
use Illuminate\Contracts\Support\Jsonable;

class BusinessException extends \Exception
{
    /** @var  array */
    protected $errors;

    /**
     * BusinessException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     * @param array $errors
     */
    public function __construct($message = "", $code = 0, Exception $previous = null, array $errors = [])
    {
        parent::__construct($message, $code, $previous);
        $this->errors = collect($errors)->map(function ($e) {
            if (!is_string($e)) {
                if ($e instanceof Jsonable) return $e->toJson();
                else return json_encode($e);
            } else return $e;
        })->toArray();
        array_unshift($this->errors, $message);
    }

    /**
     * @param Exception $ex
     *
     * @return BusinessException
     */
    public static function from(Exception $ex)
    {
        return new self($ex->getMessage(), $ex->getCode(), $ex);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

}