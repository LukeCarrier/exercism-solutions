<?php

function toDecimal(string $number): int
{
    if (!preg_match('/^[0-2]+$/', $number)) {
        return 0;
    }

    $places = str_split(strrev($number));
    array_walk($places, function(&$number, $place) {
        $number = $number * 3 ** $place;
    });

    return array_sum($places);
}
