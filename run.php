<?php

use AdventOfCode2017\Common\DaysSolversMapper;
use AdventOfCode2017\Common\SolutionRunner;

require_once "bootstrap.php";

if ($argc !== 3) {
    print("The solution runner requires two integer arguments: the day of the problem and the part. Example run solution for day 9, part 2: php run.php 9 2");
    exit(1);
}

try {
    $output = (new SolutionRunner(new DaysSolversMapper()))->run($argv[1], $argv[2]);
} catch (\Exception $exception) {
    $output = $exception->getMessage();
}

print($output);
