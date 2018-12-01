<?php

use AdventOfCode\Common\DaysSolversMapper;
use AdventOfCode\Common\SolutionRunner;

require_once "bootstrap.php";

if ($argc !== 4) {
    print("The solution runner requires three integer arguments: the year of the event, the day and the part of the problem. Example run solution for the 2017 event, day 9, part 2: php run.php 2017 9 2");
    exit(1);
}

try {
    $output = (new SolutionRunner(new DaysSolversMapper()))->run($argv[1], $argv[2], $argv[3]);
} catch (\Exception $exception) {
    $output = $exception->getMessage();
}

print($output);
