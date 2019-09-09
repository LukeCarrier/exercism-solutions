<?php

function square(int $square): string
{
    if ($square < 1 || $square > 64) {
        throw new InvalidArgumentException('$square must be within the range 1-64');
    }
    return bcpow(2, $square - 1);
}

function total(): string
{
    return bcsub(bcpow(2, 64), 1);
}
