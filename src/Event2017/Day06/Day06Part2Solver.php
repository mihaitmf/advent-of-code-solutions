<?php

namespace AdventOfCode\Event2017\Day06;

use AdventOfCode\Common\Solver;

/**
http://adventofcode.com/2017/day/6

--- Part Two ---

Out of curiosity, the debugger would also like to know the size of the loop: starting from a state that has already been seen, how many block redistribution cycles must be performed before that same state is seen again?

In the example above, 2 4 1 2 is seen again after four cycles, and so the answer in that example would be 4.

How many cycles are in the infinite loop that arises from the configuration in your puzzle input?

Although it hasn't changed, you can still get your puzzle input.
14	0	15	12	11	11	3	5	1	6	8	4	9	1	8	4

Your puzzle answer was 1037.
 */
class Day06Part2Solver implements Solver
{
    /** @var Day06Part1Solver */
    private $part1Solver;

    public function __construct(Day06Part1Solver $part1Solver)
    {
        $this->part1Solver = $part1Solver;
    }

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $states = [$input];
        $blocks = array_map('intval', explode("\t", $input));

        while (true) {
            $blocks = $this->part1Solver->redistribute($blocks);

            $newState = implode("\t", $blocks);
            foreach ($states as $index => $state) {
                if ($state === $newState) {
                    return (string)(count($states) - $index);
                }
            }
            $states[] = $newState;
        }
    }
}
