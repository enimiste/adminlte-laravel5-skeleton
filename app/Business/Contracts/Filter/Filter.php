<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 07/04/17
 * Time: 16:41
 */

namespace App\Business\Contracts\Filter;


use App\Business\Exception\BusinessException;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;

class Filter
{

    /** @var  string */
    protected $op = 'and';
    /** @var  int */
    protected $page;
    /** @var  int */
    protected $page_size;
    /** @var  array ['attribute'=>'asc|desc'] */
    protected $order_by = [];

    //TODO : Add more props as you need them

    /**
     * @param int $page_size
     * @param int $page
     */
    function __construct($page_size = 20, $page = 1)
    {
        $this->page = $page;
        $this->page_size = $page_size;
    }


    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return mixed
     */
    public function getPageSize()
    {
        return $this->page_size;
    }

    /**
     * @return string
     */
    public function getOp()
    {
        return $this->op;
    }

    /**
     * @param string $op
     * @return Filter
     */
    public function setOp($op)
    {
        $this->op = in_array($op, ['and', 'or']) ? $op : 'and';

        return $this;
    }

    /**
     * @return array
     */
    public function getOrderBy()
    {
        return $this->order_by;
    }

    /**
     * @param array $order_by
     * @return Filter
     * @throws BusinessException
     */
    public function setOrderBy($order_by)
    {
        $this->order_by = $order_by;
        $obj = new \ReflectionObject($this);
        foreach ($order_by as $attr => $direction) {
            if (!$obj->hasProperty($attr))
                throw new BusinessException('Invalid order by attribute : ' . $attr);
        }

        return $this;
    }

    /**
     * @return Filter
     */
    public static function emptyVersion()
    {
        return new self();
    }

    /**
     * @param int $page
     * @return Filter
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @param int $page_size
     * @return Filter
     */
    public function setPageSize($page_size)
    {
        $this->page_size = $page_size;

        return $this;
    }

}