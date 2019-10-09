<?php

function toDecimal(string $number): int
{
    $places = str_split(strrev($number));
    $outOfRange = array_filter($places, function($place) {
        return $place > 2;
    });
    if (count($outOfRange)) {
        return 0;
    }

    array_walk($places, function(&$number, $place) {
        $number = $number * 3 ** $place;
    });

    return array_sum($places);
}
