<?php
namespace AdventOfCode2017\Day05;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day05Part2Solver implements Solver
{
    /**
     * @param string $input
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

        return $jumps;
    }

    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                '0
3
0
1
-3',
                '10'
            ),
        ];
    }
}