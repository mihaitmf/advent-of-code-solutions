<?php

namespace AdventOfCode\Tests;

use PHPUnit_Framework_BaseTestListener;
use PHPUnit_Framework_Test;

class TestResourceUsageListener extends PHPUnit_Framework_BaseTestListener
{
    /** @var float */
    private $previousPeakMemoryUsage = 0;

    /**
     * A test ended.
     *
     * @param PHPUnit_Framework_Test $test
     * @param float $time
     */
    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        $currentPeakMemoryUsage = memory_get_peak_usage(true) / 1024 / 1024;
        $currentTestMemoryUsage = $currentPeakMemoryUsage - $this->previousPeakMemoryUsage;
        $this->previousPeakMemoryUsage = $currentPeakMemoryUsage;

        printf("Time: %s, Memory: %4.2fMB\n", \PHP_Timer::secondsToTimeString($time), $currentTestMemoryUsage);
    }
}
