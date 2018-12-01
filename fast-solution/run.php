<?php

$input = trim(file_get_contents("input.txt"));

$result = 0;

// single string input
$input = str_split($input);
foreach ($input as $i => $currentChar) {
    $currentChar;
}

// single row input
$items = parseItems($input);
foreach ($items as $itemIndex => $item) {
    $item;
}

// single column input
$rows = parseRows($input);
foreach ($rows as $rowIndex => $row) {
    $row;
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

print($result);


function parseRows($input) {
    return explode("\n", $input);
}

function parseItems($input) {
    return explode("\t", $input);
}

function parseMatrix($input) {
    $matrix = [];
    $rows = parseRows($input);

    foreach ($rows as $row) {
        $matrix[] = parseItems($row);
    }

    return $matrix;
}
