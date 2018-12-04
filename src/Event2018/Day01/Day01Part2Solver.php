<?php

namespace AdventOfCode\Event2018\Day01;

use AdventOfCode\Common\InputParser;
use AdventOfCode\Common\Solver;

/**
 * http://adventofcode.com/2018/day/1
 *
--- Part Two ---
You notice that the device repeats the same frequency change list over and over. To calibrate the device, you need to find the first frequency it reaches twice.

For example, using the same list of changes above, the device would loop as follows:

Current frequency  0, change of +1; resulting frequency  1.
Current frequency  1, change of -2; resulting frequency -1.
Current frequency -1, change of +3; resulting frequency  2.
Current frequency  2, change of +1; resulting frequency  3.
(At this point, the device continues from the start of the list.)
Current frequency  3, change of +1; resulting frequency  4.
Current frequency  4, change of -2; resulting frequency  2, which has already been seen.
In this example, the first frequency reached twice is 2. Note that your device might need to repeat its list of frequency changes many times before a duplicate frequency is found, and that duplicates might be found while in the middle of processing the list.

Here are other examples:

+1, -1 first reaches 0 twice.
+3, +3, +4, -2, -4 first reaches 10 twice.
-6, +3, +8, +5, -6 first reaches 5 twice.
+7, +7, -2, -7, -4 first reaches 14 twice.
What is the first frequency your device reaches twice?

Your puzzle answer was 66932.
 */
class Day01Part2Solver implements Solver
{
    /**
     * @Inject
     * @var InputParser
     */
    private $inputParser;

    /**
     * @Inject
     * @var Day01Part1Solver
     */
    private $part1Solver;

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $currentFrequency = 0;
        $frequencies = [];
        $frequencies[0] = 1;

        $items = $this->inputParser->parseRows($input);

        while (true) {
            foreach ($items as $i => $item) {
                $operator = $item[0];
                $value = (int)substr($item, 1);

                $currentFrequency = $this->part1Solver->doOperation($currentFrequency, $operator, $value);

                if (array_key_exists($currentFrequency, $frequencies)) {
                    return (string)$currentFrequency;
                }

                $frequencies[$currentFrequency] = 1;
            }
        }
    }
}
