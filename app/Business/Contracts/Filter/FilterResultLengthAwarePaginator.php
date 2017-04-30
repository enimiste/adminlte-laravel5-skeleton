<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 07/04/17
 * Time: 16:41
 */

namespace App\Business\Contracts\Filter;


use App\Business\Exception\BusinessException;
use Illuminate\Pagination\LengthAwarePaginator;

class FilterResultLengthAwarePaginator extends LengthAwarePaginator
{

    public function __construct($items, $total, $perPage, $currentPage = null, array $options = [])
    {
        parent::__construct($items, $total, $perPage, $currentPage, $options);
    }

    /**
     * Checks if all items in the collection are of a specific type
     *
     * @param string $clazz class full name
     * @throws BusinessException
     */
    public function checkContentTypes($clazz)
    {
        $this->items->each(function ($item) use ($clazz) {
            if (!$item instanceof $clazz)
                throw new BusinessException('The FilterResultCollection should be composed only of objects of type : ' . $clazz);
        });
    }

    /**
     * @return FilterResultLengthAwarePaginator
     */
    public static function emptyPaginator()
    {
        return new self([], 0, 10, 1);
    }
}