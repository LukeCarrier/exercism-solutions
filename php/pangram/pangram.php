<?php

const ASCII_LOWER_START = 0x61;
const ASCII_LOWER_END = 0x7a;

function isPangram(string $string): bool
{
    $found = [];
    foreach (str_split(strtolower($string)) as $char) {
        $asciiValue = ord($char);
        if ($asciiValue >= ASCII_LOWER_START && $asciiValue <= ASCII_LOWER_END) {
            $found[$asciiValue] = true;
        }
    }

    return count($found) === 26;
}
