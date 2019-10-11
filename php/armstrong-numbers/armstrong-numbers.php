<?php

function isArmstrongNumber(int $number): bool
{
    $count = floor(log10($number)) + 1;
    $sum = 0;
    $work = $number;

    while ($work > 0) {
        $sum += ($work % 10) ** $count;
        $work /= 10;
    }

    return $number == $sum;
}
