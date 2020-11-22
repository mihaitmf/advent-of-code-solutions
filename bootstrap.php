<?php

use AdventOfCode\Common\ExecutionStats\ScriptRunStatistics;

$startTime = microtime(true);

$classLoader = require_once __DIR__ . '/vendor/autoload.php';

register_shutdown_function(function () use ($startTime) {
    ScriptRunStatistics::printStats($startTime);
});
