<?php

namespace AdventOfCode\Event2018\Day10;

use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;

/**
 * http://adventofcode.com/2018/day/10
 *
--- Part Two ---
Good thing you didn't have to wait, because that would have taken a long time - much longer than the 3 seconds in the example above.

Impressed by your sub-hour communication capabilities, the Elves are curious: exactly how many seconds would they have needed to wait for that message to appear?

Your puzzle answer was 10355.
 */
class Day10Part2Solver implements Solver
{
    /**
     * @Inject
     * @var Day10Part1Solver
     */
    private $part1Solver;

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        /**
         * @var Point[] $points
         * @var int[] $pointsPositions Map<string, int>
         */
        list($points, $pointsPositions) = $this->part1Solver->parseInput($input);

        $ticks = 0;
        while (!$this->part1Solver->arePointsAligned($points, $pointsPositions)) {
            $this->part1Solver->updatePointsPositions($points, $pointsPositions);
            $ticks++;
        }

        return (string)$ticks;
    }
}
