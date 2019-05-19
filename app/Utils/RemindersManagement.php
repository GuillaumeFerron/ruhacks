<?php


namespace App\Utils;


use App\Reminder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RemindersManagement
{
    public static function getRemindersBetweenTimes($start_time, $end_time)
    {
        return Reminder
            ::where('date_time', '>=', Carbon::parse(date($start_time))->format('Y-m-d h:i:s'))
            ->where('date_time', '<=', Carbon::parse(date($end_time))->format('Y-m-d h:i:s'))
            ->get();
    }
}
