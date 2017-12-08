<?php
namespace AdventOfCode2017\Day01;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day01Part2Solver implements Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        $result = 0;
        $halfLength = strlen($input) / 2;
        for ($i = 0; $i < $halfLength; $i++) {
            if ($input[$i] == $input[$i + $halfLength]) {
                $result += $input[$i];
            }
        }

        return (string)($result * 2);
    }

    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of('1212', '6'),
            SolutionExample::of('1221', '0'),
            SolutionExample::of('123425', '4'),
            SolutionExample::of('123123', '12'),
            SolutionExample::of('12131415', '4'),
        ];
    }
}