<?php

function toRoman(int $number): string
{
    $values = [
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000,
    ];
    arsort($values);


    // TODO: on repetitions of 4 we have to subtract the lower value from the larger one on the right
    // IV = 4
    // IX = 9
    // XL = 40
    // XC = 90
    // CD = 400
    // CM = 900
    $result = '';
    foreach ($values as $letter => $value) {
        $count = $number / $value;
        $result .= str_repeat($letter, $count);
        $number = $number % $value;
    }

    return $result;
}
