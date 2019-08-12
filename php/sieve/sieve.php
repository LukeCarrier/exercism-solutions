<?php

function sieve(int $limit)
{
    if ($limit < 2) {
        return [];
    }

    $number = 2;
    $range = range($number, $limit);
    $primes = array_combine($range, $range);

    while ($number ** 2 <= $limit) {
        foreach (range($number * 2, $limit, $number) as $i) {
            unset($primes[$i]);
        }
        $number = next($primes);
    }

    return array_values($primes);
}
