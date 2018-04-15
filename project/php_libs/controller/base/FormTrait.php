<?php

trait FormTrait
{
    public static function getDate()
    {
        $years  = [];
        $months = [];
        $days   = [];
        $next_year = date('Y') + 1;
        // 年を作成
        for ($i = 1970; $i < $next_year; $i++) {
            $year = sprintf("%04d", $i);
            $years[$year] = $year . '年';
        }
        // 月を作成
        for($i = 1; $i < 13; $i++) {
            $month = sprintf("%02d", $i);
            $months[$month] = $month . '月';
        }
        // 日を作成
        for($i = 1; $i < 32; $i++) {
            $day = sprintf("%02d", $i);
            $days[$day] = $day . '日';
        }
        $date = [$years, $months, $days];
        return $date;
    }

    public static function getGenders()
    {
        $genders = ['男性', '女性'];
        return $genders;
    }
}