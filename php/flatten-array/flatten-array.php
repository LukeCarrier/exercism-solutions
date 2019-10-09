<?php

function flatten(array $array): array
{
    $result = [];
    array_walk_recursive($array, function($item) use(&$result) {
        if ($item !== null) {
            $result[] = $item;
        }
    });

    return $result;
}
