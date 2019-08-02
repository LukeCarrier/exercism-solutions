<?php

function isValid(string $input) : bool
{
    $valid = preg_match_all('/^[\d ]+/', $input, $digits);
    $digits = filter_var_array($digits[0], FILTER_SANITIZE_NUMBER_INT);
    $digits = array_reverse(str_split(implode('', $digits)));
    if (!$valid || count($digits) <= 1) {
        return false;
    }

    $sum = 0;
    foreach ($digits as $i => $digit) {
        $digit = (int) $digit;
        if ($i % 2 === 1) {
            $digit *= 2;
            if ($digit > 9) {
                $digit -= 9;
            }
        }
        $sum += $digit;
    }

    return $sum % 10 === 0;
}
