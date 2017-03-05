<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 26/12/16
 * Time: 16:45
 */

namespace App\Business\DTO;


use App\Business\Assert\AssertThat;
use App\Business\Exception\BusinessException;

class FilterDto
{
    /** @var  string */
    protected $keyword;
    /** @var  array ['column'=>'asc|desc'] */
    protected $sortBys;
    /** @var  array [$column, $op, $value] */
    protected $filters;


    /**
     * @param string $keyword
     */
    private function __construct($keyword = null)
    {
        AssertThat::nullOrString($keyword, 'Vous devez spécifié un mot clés de type string');
        $this->keyword = trim($keyword);
        $this->sortBys = [];
        $this->filters = [];
    }

    /**
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param $column
     * @param string $dir
     * @return $this
     *
     * @throws BusinessException
     */
    public function addSort($column, $dir = 'asc')
    {
        AssertThat::stringNotEmpty($column, 'sort_by value should be not empty');
        AssertThat::in($dir, ['asc', 'desc'], 'Only asc or desc are allowed for sort direction');

        $this->sortBys[$column] = $dir;

        return $this;
    }

    /**
     *
     * @return array ['column'=>'asc|desc']
     */
    public function getSortBys()
    {
        return $this->sortBys;
    }


    /**
     * @param string $column
     * @param string $op
     * @param string $value
     * @return $this
     */
    public function addFilter($column, $op, $value)
    {
        AssertThat::stringNotEmpty($column, 'filter column should not be empty');
        $operators = [
            '<',
            '<=',
            '>',
            '>=',
            '=',
            '<>',
            'like',
        ];
        AssertThat::in($op, $operators, 'Only [' . implode(',', $operators) . '] are allowed for sort direction');
        $this->filters = [$column, $op, $value];
        return $this;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

}