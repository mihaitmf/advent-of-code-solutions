<?php

$input = trim(file_get_contents("input.txt"));
$result = solve($input);
print($result);

function solve($input)
{
    return "";

    // single column input (multiple rows with a single value)
    $items = parseRows($input);
    foreach ($items as $i => $item) {
        $item;
    }

    // single string input
    $input = str_split($input);
    foreach ($input as $i => $currentChar) {
        $currentChar;
    }

    // single row input
    $items = parseItems($input);
    foreach ($items as $i => $item) {
        $item;
    }

    // matrix input
    $matrix = parseMatrix($input);
    $rows = parseRows($input);
    foreach ($rows as $rowIndex => $row) {
        $items = parseItems($row);

        foreach ($items as $itemIndex => $item) {
            $item;
        }
    }
}

function parseRows($input) {
    return explode("\n", $input);
}

function parseItemsByTab($input) {
    return explode("\t", $input);
}

function parseItemsBySpace($input) {
    return explode(" ", $input);
}

function parseMatrix($input) {
    $matrix = [];
    $rows = parseRows($input);

    foreach ($rows as $row) {
        $matrix[] = parseItems($row);
    }

    return $matrix;
}
