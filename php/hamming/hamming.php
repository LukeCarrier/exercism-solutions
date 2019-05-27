<?php

function distance(string $strandA, string $strandB): int
{
    if (strlen($strandA) !== strlen($strandB)) {
        throw new InvalidArgumentException('DNA strands must be of equal length.');
    }
    $strandA = str_split($strandA);
    $strandB = str_split($strandB);
    return count(array_diff_assoc($strandA, $strandB));
}
