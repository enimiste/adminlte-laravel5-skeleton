<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 07/04/17
 * Time: 16:50
 */

namespace App\Business\Filter;


use App\Business\Contracts\Filter\CustomAdvancedSearchInterface;
use App\Business\Contracts\Filter\Filter;
use App\Business\Contracts\Filter\FilterResultLengthAwarePaginator;

class SqlCustomAdvancedSearchEngine implements CustomAdvancedSearchInterface
{

    /**
     * @param Filter $filter
     * @return FilterResultLengthAwarePaginator
     */
    public function apply(Filter $filter)
    {
        //Here your query your DB and build a collection of CustomFilterResult objects
        return new FilterResultLengthAwarePaginator([], 0, $filter->getPageSize(), $filter->getPage());
    }
}