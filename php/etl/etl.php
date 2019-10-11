<?php

function transform(array $scores): array
{
    $result = [];
    foreach ($scores as $score => $letters) {
        foreach ($letters as $letter) {
            $result[strtolower($letter)] = $score;
        }
    }
    return $result;
}
