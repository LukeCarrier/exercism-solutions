<?php

function wordCount(string $text): array
{
    preg_match_all('/\b[\d\p{L}]+\b/', mb_strtolower($text), $matches);
    return array_count_values($matches[0]);
}
