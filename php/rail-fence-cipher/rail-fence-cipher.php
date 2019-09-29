<?php

function emptyMatrix(int $numChars, int $numRails): array
{
    return array_fill(0, $numRails, array_fill(0, $numChars, null));
}

function advanceRail($numRails, int $rail, int $railIncrement): array
{
    if ($rail === 0) {
        $railIncrement = 1;
    } elseif ($rail === $numRails - 1) {
        $railIncrement = -1;
    }
    $rail += $railIncrement;

    return [$rail, $railIncrement];
}

function plot(array &$rails, string $clearText): void
{
    $numRails = count($rails);
    $rail = $railIncrement = 0;
    foreach (str_split($clearText) as $index => $char) {
        $rails[$rail][$index] = $char;
        [$rail, $railIncrement] = advanceRail($numRails, $rail, $railIncrement);
    }
}

function plotCipherText(array &$rails, string $cipherText): void
{
    plot($rails, str_repeat('?', strlen($cipherText)));

    $index = 0;
    foreach ($rails as &$rail) {
        foreach ($rail as &$placeholder) {
            if ($placeholder === null) {
                continue;
            }
            $placeholder = $cipherText{$index};
            $index++;
        }
    }
}

function format(array $rails): string
{
    $result = '';
    foreach ($rails as $rail) {
        foreach ($rail as $char) {
            $result .= $char === null ? '.' : $char;
        }
        $result .= PHP_EOL;
    }
    return $result;
}

function encode(string $clearText, int $numRails): string
{
    $rails = emptyMatrix(strlen($clearText), $numRails);
    plot($rails, $clearText);
    return implode(array_map('implode', $rails));
}

function decode(string $cipherText, int $numRails): string
{
    $rails = emptyMatrix(strlen($cipherText), $numRails);
    plotCipherText($rails, $cipherText);

    $result = '';
    $numRails = count($rails);
    $rail = $railIncrement = 0;
    for ($i = 0; $i < strlen($cipherText); $i++) {
        $result .= $rails[$rail][$i];
        [$rail, $railIncrement] = advanceRail($numRails, $rail, $railIncrement);
    }

    return $result;
}
