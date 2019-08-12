<?php

function firstVowelPosition(string $word): int
{
    preg_match('/\bS?QU/i', $word, $matches);
    if (count($matches) === 1) {
        return strlen($matches[0]);
    }

    preg_match('/\bYT|XR/i', $word, $matches);
    if (count($matches) === 1) {
        return 0;
    }

    return strcspn($word, 'aeiouAEIOU');
}

function translate(string $text): string
{
    $words = explode(' ', $text);
    foreach ($words as &$word) {
        $firstVowelPos = firstVowelPosition($word);
        if ($firstVowelPos !== 0) {
            $leadingConsonants = substr($word, 0, $firstVowelPos);
            $word = substr($word, $firstVowelPos) . $leadingConsonants;
        }
        $word .= 'ay';
    }

    return implode(' ', $words);
}
