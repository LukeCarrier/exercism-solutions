<?php

function toRoman(int $number): string
{
    $numerals = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I',
    ];

    $result = '';
    foreach ($numerals as $value => $letter) {
        $count = $number / $value;
        $result .= str_repeat($letter, $count);
        $number = $number % $value;
    }

    return $result;
}
