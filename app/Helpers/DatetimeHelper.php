<?php

namespace App\Helpers;

use DateInterval;
use DatePeriod;
use DateTime;

class DatetimeHelper {
    public static function getFirstDayOfMonth($monthName, $year)
    {
        return new DateTime('first day of ' . $monthName . ' ' .$year);
    }

    public static function getLastDayOfMonth($monthName, $year)
    {
        return new DateTime('last day of ' .$monthName . ' ' . $year);
    }

    public static function getFirstWeekOfMonth($monthName, $year=null){
        if($year==null) $year = (new DateType())->format('Y');
        $firstDay = DatetimeHelper::getFirstDayOfMonth($monthName, $year);
        $weekNum = $firstDay->format('W');
        $yearNum = $firstDay->format('Y');
        $dto = new DateTime();
        $dto->setISODate($yearNum, $weekNum);
        return $dto;
    }

    public static function getLastWeekOfMonth($monthName,$year = null)
    {
        if ($year == null) $year = (new DateType())->format('Y');
        $firstDay = DatetimeHelper::getLastDayOfMonth($monthName, $year);
        $weekNum = $firstDay->format('W');
        $yearNum = $firstDay->format('Y');
        $dto = new DateTime();
        $dto->setISODate($yearNum, $weekNum);
        $dto->modify('+6 days');
        return $dto;
    }

    public static function getDateWeekPeriod($startdate, $endDate) {
        $interval = new DateInterval('P1W');
        $period   = new DatePeriod($startdate, $interval, $endDate);
        return $period;
    }

    public static function getDateWeekPeriodByMonth($monthName=null, $year=null) {
        if (empty($monthName)) $monthName = strtolower((new DateTime())->format('F'));
        $startdate = DatetimeHelper::getFirstWeekOfMonth($monthName, $year);
        $endDate = DatetimeHelper::getLastWeekOfMonth($monthName, $year);
        return DatetimeHelper::getDateWeekPeriod($startdate, $endDate);
    }
}
