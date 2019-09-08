<?php

const DOUBLES = [0, 2, 4, 6, 8, 1, 3, 5, 7, 9];

function isValid(string $input) : bool
{
    $input = str_replace(' ', '', $input);
    if (0 !== preg_match('/[^0-9]+/', $input) || strlen($input) < 2) {
        return false;
    }
    $input = array_reverse(str_split($input));

    $sum = 0;
    foreach ($input as $i => &$digit) {
        if ($i % 2) {
            $digit = DOUBLES[$digit];
        }
    }

    return array_sum($input) % 10 === 0;
}
