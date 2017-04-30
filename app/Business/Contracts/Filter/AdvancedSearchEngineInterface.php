<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 07/04/17
 * Time: 16:40
 */

namespace App\Business\Contracts\Filter;


interface AdvancedSearchEngineInterface
{

    /**
     * This function can edit the $filter object (setPageSize, setPage)
     *
     * @param Filter $filter
     * @return FilterResultLengthAwarePaginator
     */
    public function apply(Filter $filter);
}