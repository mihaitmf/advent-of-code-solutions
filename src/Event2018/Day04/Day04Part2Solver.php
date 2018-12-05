<?php

namespace AdventOfCode\Event2018\Day04;

use AdventOfCode\Common\InputParser;
use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;

/**
 * http://adventofcode.com/2018/day/4
 *
--- Part Two ---
Strategy 2: Of all guards, which guard is most frequently asleep on the same minute?

In the example above, Guard #99 spent minute 45 asleep more than any other guard or minute - three times in total. (In all other cases, any guard spent any minute asleep at most twice.)

What is the ID of the guard you chose multiplied by the minute you chose? (In the above example, the answer would be 99 * 45 = 4455.)

Your puzzle answer was 94826.
 */
class Day04Part2Solver implements Solver
{
    /**
     * @Inject
     * @var InputParser
     */
    private $inputParser;

    /**
     * @Inject
     * @var Day04Part1Solver
     */
    private $part1Solver;

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $items = $this->inputParser->parseRows($input);

        $itemsByDate = $this->part1Solver->getSortedItemsByDateTime($items);

        $currentGuardId = 0;
        $fallAsleepMinute = 0;

        $guardSleepCountPerMinute = [];
        $maxSleepPerMinuteCount = 0;
        $maxSleepPerMinuteCountGuardId = 0;
        $minuteWithMaxSleepPerMinuteCount = 0;

        foreach ($itemsByDate as $dateTime => $item) {
            $matches = [];
            if (preg_match("/Guard #(\d+) begins shift/", $item, $matches) === 1) {
                $currentGuardId = $matches[1];

            } elseif (preg_match("/falls asleep/", $item) === 1) {
                $fallAsleepMinute = $this->part1Solver->parseMinute($dateTime);

            } elseif (preg_match("/wakes up/", $item) === 1) {
                $wakeUpMinute = $this->part1Solver->parseMinute($dateTime);

                // increment the count for each minute slept
                if (!array_key_exists($currentGuardId, $guardSleepCountPerMinute)) {
                    $guardSleepCountPerMinute[$currentGuardId] = [];
                }
                for ($i = $fallAsleepMinute; $i < $wakeUpMinute; $i++) {
                    if (!array_key_exists($i, $guardSleepCountPerMinute[$currentGuardId])) {
                        $guardSleepCountPerMinute[$currentGuardId][$i] = 1;
                    } else {
                        $guardSleepCountPerMinute[$currentGuardId][$i]++;

                        if ($guardSleepCountPerMinute[$currentGuardId][$i] > $maxSleepPerMinuteCount) {
                            $maxSleepPerMinuteCount = $guardSleepCountPerMinute[$currentGuardId][$i];
                            $maxSleepPerMinuteCountGuardId = $currentGuardId;
                            $minuteWithMaxSleepPerMinuteCount = $i;
                        }
                    }
                }
            }
        }

        return (string)($maxSleepPerMinuteCountGuardId * $minuteWithMaxSleepPerMinuteCount);
    }
}
