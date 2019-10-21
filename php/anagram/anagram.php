<?php

// Polyfill for PHP <= 7.4
if (!function_exists('mb_str_split')) {
    function mb_str_split(string $string, int $splitLength = 1, string $encoding=null): array
    {
        $encoding = $encoding ?? mb_internal_encoding();
        $splitLength = $splitLength <= 0 ? 1 : $splitLength;

        $result = [];
        $stringLength = mb_strlen($string);
        for ($i = 0; $i < $stringLength; $i += $splitLength) {
            $result[] = mb_substr($string, $i, $splitLength);
        }

        return $result;
    }
}

function sortChars(string $string, $caseSensitive=false)
{
    if (!$caseSensitive) {
        $string = mb_strtolower($string);
    }

    $chars = mb_str_split($string);
    sort($chars, SORT_STRING);
    return implode('', $chars);
}

function detectAnagrams(string $word, array $possibilities): array
{
    $lowerWord = mb_strtolower($word);
    $sortedWord = sortChars($word);

    return array_values(array_filter($possibilities, function($possibility) use($word, $lowerWord, $sortedWord) {
        $sortedPossibility = sortChars($possibility);

        return $sortedWord === $sortedPossibility
                && $lowerWord !== mb_strtolower($possibility);
    }));
}
