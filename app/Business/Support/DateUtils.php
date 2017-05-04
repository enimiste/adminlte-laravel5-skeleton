<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 15/03/2017
 * Time: 14:06
 */

namespace App\Business\Support;


use Carbon\Carbon;

class DateUtils
{

    /**
     * @param Carbon $date
     * @return Carbon
     */
    public static function addMonth(Carbon $date)
    {
        /** @var Carbon $date_ */
        $date_ = $date->copy()->day(1);
        $month = $date_->month;
        if ($month == 1) $date_->month(2);
        else $date_->addMonth(1);

        $date_->setTime($date->hour, $date->minute, $date->second);

        return $date_;
    }

    /**
     * @param Carbon $date
     * @param int $nbr
     * @return Carbon
     */
    public static function addMonths(Carbon $date, $nbr = 1)
    {
        return array_reduce(range(0, $nbr), function (Carbon $d) {
            return self::addMonth($d);
        }, $date);
    }
}