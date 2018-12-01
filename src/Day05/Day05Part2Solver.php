<?php

namespace AdventOfCode2017\Day05;

use AdventOfCode2017\Common\Solver;

/**
http://adventofcode.com/2017/day/5

--- Part Two ---

Now, the jumps are even stranger: after each jump, if the offset was three or more, instead decrease it by 1. Otherwise, increase it by 1 as before.

Using this rule with the above example, the process now takes 10 steps, and the offset values after finding the exit are left as 2 3 2 3 -1.

How many steps does it now take to reach the exit?

Although it hasn't changed, you can still get your puzzle input.

Your puzzle answer was 30513679.
 */
class Day05Part2Solver implements Solver
{
    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $instructions = explode("\n", $input);

        $lastPosition = count($instructions);
        $position = 0;
        $jumps = 0;

        while ($position < $lastPosition) {
            $value = $instructions[$position];

            if ($value >= 3) {
                $instructions[$position]--;
            } else {
                $instructions[$position]++;
            }

            $position += $value;
            $jumps++;
        }

        return (string)$jumps;
    }
}
