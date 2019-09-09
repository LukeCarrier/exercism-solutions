<?php

function square(int $square): string
{
    if ($square < 1 || $square > 64) {
        throw new InvalidArgumentException('$square must be within the range 1-64');
    }
    return gmp_pow(2, $square - 1);
}

function total(): string
{
    return gmp_init(str_repeat(1, 64), 2);
}
