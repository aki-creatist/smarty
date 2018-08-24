<?php

$genders  = getGenders();
$traffics = getTraffics();
list ($years, $months, $days) = getDates(); // 複数の値を受け取る時にはlistを使用

/**
 * $genders = ['男性','女性']; を取得する関数
 */
function getGenders()
{
    $genders = ['男性','女性'];
    return $genders;
}

/**
 * $traffics = ['徒歩', '自転車', 'バス', '電車', '車・バイク']; を取得する関数
 */
function getTraffics()
{
    $traffics = ['徒歩', '自転車', 'バス', '電車', '車・バイク'];
    return $traffics;
}

/**
 * [$years, $months, $days]をまとめて取得する関数
 */
function getDates()
{
    $next_year = date( 'Y' ) + 1;
    // 年を作成
    for ($i = 2010; $i < $next_year; $i++) {
        $year = sprintf("%04d", $i);
        $years[$year] = $year;
    }
    // 月を作成
    for ($i = 1; $i < 13 ; $i++) {
        $month = sprintf("%02d", $i);
        $months[$month] = $month;
    }
    // 日を作成
    for ($i = 1; $i < 32; $i++) {
        $day = sprintf("%02d", $i);
        $days[$day] = $day . '日';
    }
    arsort($years);

    return [$years, $months, $days];
}