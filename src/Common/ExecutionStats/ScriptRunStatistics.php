<?php

namespace AdventOfCode\Common\ExecutionStats;

class ScriptRunStatistics
{
    /**
     * @param float $startTime
     *
     * @return void
     */
    public static function printStats($startTime)
    {
        print(sprintf(
            "\n\nExecution time: %.4f seconds\nMemory peak usage: %.2f MB\n",
            microtime(true) - $startTime,
            memory_get_peak_usage(true) / 1024 / 1024
        ));
    }
}
