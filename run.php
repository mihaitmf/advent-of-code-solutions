<?php

use AdventOfCode\Common\Container;
use AdventOfCode\Common\Runner\CommandLineArgumentsParser;
use AdventOfCode\Common\Runner\SolutionRunner;

$startTime = microtime(true);

require_once __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php";

try {
    list($year, $day, $part) = Container::get(CommandLineArgumentsParser::class)->parse($argv);

} catch (InvalidArgumentException $exception) {
    print($exception->getMessage());
    exit(1);
}

try {
    $output = Container::get(SolutionRunner::class)->run($year, $day, $part);
    print("Result is: {$output}");

} catch (Exception $exception) {
    print("Exception: {$exception->getMessage()}");
}

print(sprintf(
    "\n\nExecution time: %.4f seconds\nMemory peak usage: %.2f MB\n",
    microtime(true) - $startTime,
    memory_get_peak_usage(true) / 1024 / 1024
));
