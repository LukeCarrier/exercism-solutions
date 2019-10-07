<?php

function squareOfSum(int $number): int
{
    return array_sum(range(0, $number)) ** 2;
}

function sumOfSquares(int $number): int
{
    return array_sum(array_map(function($number) {
        return $number ** 2;
    }, range(0, $number)));
}

function difference(int $number): int
{
    return squareOfSum($number) - sumOfSquares($number);
}
