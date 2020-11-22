<?php

namespace AdventOfCode\Event2018\Day04;

use AdventOfCode\Common\InputParser;
use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;
use RuntimeException;

/**
 * http://adventofcode.com/2018/day/4
 *
--- Day 4: Repose Record ---
You've sneaked into another supply closet - this time, it's across from the prototype suit manufacturing lab. You need to sneak inside and fix the issues with the suit, but there's a guard stationed outside the lab, so this is as close as you can safely get.

As you search the closet for anything that might help, you discover that you're not the first person to want to sneak in. Covering the walls, someone has spent an hour starting every midnight for the past few months secretly observing this guard post! They've been writing down the ID of the one guard on duty that night - the Elves seem to have decided that one guard was enough for the overnight shift - as well as when they fall asleep or wake up while at their post (your puzzle input).

For example, consider the following records, which have already been organized into chronological order:

[1518-11-01 00:00] Guard #10 begins shift
[1518-11-01 00:05] falls asleep
[1518-11-01 00:25] wakes up
[1518-11-01 00:30] falls asleep
[1518-11-01 00:55] wakes up
[1518-11-01 23:58] Guard #99 begins shift
[1518-11-02 00:40] falls asleep
[1518-11-02 00:50] wakes up
[1518-11-03 00:05] Guard #10 begins shift
[1518-11-03 00:24] falls asleep
[1518-11-03 00:29] wakes up
[1518-11-04 00:02] Guard #99 begins shift
[1518-11-04 00:36] falls asleep
[1518-11-04 00:46] wakes up
[1518-11-05 00:03] Guard #99 begins shift
[1518-11-05 00:45] falls asleep
[1518-11-05 00:55] wakes up
Timestamps are written using year-month-day hour:minute format. The guard falling asleep or waking up is always the one whose shift most recently started. Because all asleep/awake times are during the midnight hour (00:00 - 00:59), only the minute portion (00 - 59) is relevant for those events.

Visually, these records show that the guards are asleep at these times:

Date   ID   Minute
000000000011111111112222222222333333333344444444445555555555
012345678901234567890123456789012345678901234567890123456789
11-01  #10  .....####################.....#########################.....
11-02  #99  ........................................##########..........
11-03  #10  ........................#####...............................
11-04  #99  ....................................##########..............
11-05  #99  .............................................##########.....
The columns are Date, which shows the month-day portion of the relevant day; ID, which shows the guard on duty that day; and Minute, which shows the minutes during which the guard was asleep within the midnight hour. (The Minute column's header shows the minute's ten's digit in the first row and the one's digit in the second row.) Awake is shown as ., and asleep is shown as #.

Note that guards count as asleep on the minute they fall asleep, and they count as awake on the minute they wake up. For example, because Guard #10 wakes up at 00:25 on 1518-11-01, minute 25 is marked as awake.

If you can figure out the guard most likely to be asleep at a specific time, you might be able to trick that guard into working tonight so you can have the best chance of sneaking in. You have two strategies for choosing the best guard/minute combination.

Strategy 1: Find the guard that has the most minutes asleep. What minute does that guard spend asleep the most?

In the example above, Guard #10 spent the most minutes asleep, a total of 50 minutes (20+25+5), while Guard #99 only slept for a total of 30 minutes (10+10+10). Guard #10 was asleep most during minute 24 (on two days, whereas any other minute the guard was asleep was only seen on one day).

While this example listed the entries in chronological order, your entries are in the order you found them. You'll need to organize them before they can be analyzed.

What is the ID of the guard you chose multiplied by the minute you chose? (In the above example, the answer would be 10 * 24 = 240.)

Your puzzle answer was 48680.
 */
class Day04Part1Solver implements Solver
{
    /**
     * @Inject
     * @var InputParser
     */
    private $inputParser;

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $items = $this->inputParser->parseRows($input);

        $itemsByDate = $this->getSortedItemsByDateTime($items);

        $currentGuardId = 0;
        $fallAsleepMinute = 0;

        $guardSleepCount = [];
        $maxSleepCount = 0;
        $maxSleepCountGuardId = 0;

        $guardSleepCountPerMinute = [];

        foreach ($itemsByDate as $dateTime => $item) {
            $matches = [];
            if (preg_match("/Guard #(\d+) begins shift/", $item, $matches) === 1) {
                $currentGuardId = $matches[1];

            } elseif (preg_match("/falls asleep/", $item) === 1) {
                $fallAsleepMinute = $this->parseMinute($dateTime);

            } elseif (preg_match("/wakes up/", $item) === 1) {
                $wakeUpMinute = $this->parseMinute($dateTime);

                // set new max of sleep minutes count if it has been reached
                if (!array_key_exists($currentGuardId, $guardSleepCount)) {
                    $guardSleepCount[$currentGuardId] = 0;
                }
                $guardSleepCount[$currentGuardId] += ($wakeUpMinute - $fallAsleepMinute);
                if ($guardSleepCount[$currentGuardId] > $maxSleepCount) {
                    $maxSleepCount = $guardSleepCount[$currentGuardId];
                    $maxSleepCountGuardId = $currentGuardId;
                }

                // increment the count for each minute asleep
                if (!array_key_exists($currentGuardId, $guardSleepCountPerMinute)) {
                    $guardSleepCountPerMinute[$currentGuardId] = [];
                }
                for ($i = $fallAsleepMinute; $i < $wakeUpMinute; $i++) {
                    if (!array_key_exists($i, $guardSleepCountPerMinute[$currentGuardId])) {
                        $guardSleepCountPerMinute[$currentGuardId][$i] = 1;
                    } else {
                        $guardSleepCountPerMinute[$currentGuardId][$i]++;
                    }
                }
            }
        }

        $countPerMinuteList = $guardSleepCountPerMinute[$maxSleepCountGuardId];
        $maxMinuteCount = 0;
        $minuteWithMaxCount = 0;
        foreach ($countPerMinuteList as $minute => $minuteCount) {
            if ($minuteCount > $maxMinuteCount) {
                $maxMinuteCount = $minuteCount;
                $minuteWithMaxCount = $minute;
            }
        }

        return (string)($maxSleepCountGuardId * $minuteWithMaxCount);
    }

    /**
     * @param string $dateTime
     *
     * @return int
     */
    public function parseMinute($dateTime)
    {
        $matches = [];
        if (preg_match("/\d\d-\d\d \d\d:(\d\d)/", $dateTime, $matches) === 1) {
            return (int)$matches[1];
        }

        throw new RuntimeException("Unable to parse minute from date");
    }

    /**
     * @param string[] $items
     *
     * @return array Map<string, string>
     */
    public function getSortedItemsByDateTime(array $items)
    {
        $itemsByDate = [];

        foreach ($items as $item) {
            $matches = [];
            $matchResult = preg_match("/^\[\d{4}-(\d+-\d+ \d\d:\d\d)\] (.*)/", $item, $matches);
            if ($matchResult !== 1) {
                throw new RuntimeException("Could not parse input");
            }

            $itemsByDate[$matches[1]] = $matches[2];
        }

        ksort($itemsByDate);

        return $itemsByDate;
    }
}
