<?php
namespace AdventOfCode2017\Day06;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day06Part2Solver implements Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        $part1Solver = new Day06Part1Solver();

        $states = [$input];
        $blocks = array_map('intval', explode("\t", $input));

        while (true) {
            $blocks = $part1Solver->redistribute($blocks);

            $newState = implode("\t", $blocks);
            foreach ($states as $index => $state) {
                if ($state === $newState) {
                    return count($states) - $index;
                }
            }
            $states[] = $newState;
        }
    }

    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                '0	2	7	0',
                '4'
            ),
            SolutionExample::of(
                '3	2	0	3	2',
                /**
                 * 0 3 1 4 2
                 * 1 4 2 0 3
                 * 2 0 3 1 4
                 * 3 1 4 2 0
                 * 4 2 0 3 1
                 * 0 3 1 4 2
                 */
                '5'
            ),
        ];
    }
}