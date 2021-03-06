<?php

use AdventOfCode\Common\Container;
use AdventOfCode\Common\InputParser;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "bootstrap.php";

$input = trim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "input.txt"));
$result = solve($input);
print($result);

function solve($input)
{
    $inputParser = Container::get(InputParser::class);

    return "";

    // single column input (multiple rows with a single value)
    $items = $inputParser->parseRows($input);
    foreach ($items as $i => $item) {
        $item;
    }

    // single string input
    $input = str_split($input);
    foreach ($input as $i => $currentChar) {
        $currentChar;
    }

    // single row input
    $items = $inputParser->parseItemsByTab($input);
    foreach ($items as $i => $item) {
        $item;
    }

    // matrix input
    $rows = $inputParser->parseRows($input);
    foreach ($rows as $rowIndex => $row) {
        $items = $inputParser->parseItemsByTab($row);

        foreach ($items as $itemIndex => $item) {
            $item;
        }
    }
}
