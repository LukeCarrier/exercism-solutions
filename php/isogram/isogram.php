<?php

function isIsogram(string $word): bool
{
    $word = mb_strtolower(mb_ereg_replace('[\p{P}\p{Z}]', '', $word));
    $word = preg_split('//u', $word, null, PREG_SPLIT_NO_EMPTY);

    return count($word) === count(array_unique($word));
}
