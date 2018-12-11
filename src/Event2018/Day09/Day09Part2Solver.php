<?php

namespace AdventOfCode\Event2018\Day09;

use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;

/**
 * http://adventofcode.com/2018/day/9
 *
--- Part Two ---
Amused by the speed of your answer, the Elves are curious:

What would the new winning Elf's score be if the number of the last marble were 100 times larger?

Your puzzle answer was 3085518618.
 */
class Day09Part2Solver implements Solver
{
    /**
     * @Inject
     * @var Day09Part1Solver
     */
    private $part1Solver;

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $matches = $this->part1Solver->parseInput($input);

        $playersNumber = (int)$matches[1];
        $lastMarbleNumber = (int)$matches[2] * 100;

        /**
         * Apparently the garbage collector produced a segmentation fault error when trying to handle a large number
         * of objects referenced by each other.
         * Error was "Process finished with exit code 139 (interrupted by signal 11: SIGSEGV)"
         */
        gc_disable();

        return $this->part1Solver->calculateMaxScore($playersNumber, $lastMarbleNumber);
    }
}
