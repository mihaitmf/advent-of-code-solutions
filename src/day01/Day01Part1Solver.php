<?php
namespace AdventOfCode2017\Day01;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day01Part1Solver implements Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        $result = 0;
        for ($i = 0; $i < strlen($input) - 1; $i++) {
            if ($input[$i] == $input[$i + 1]) {
                $result += $input[$i];
            }
        }

        if ($input[0] == $input[strlen($input) - 1]) {
            $result += $input[0];
        }

        return (string)$result;
    }

    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of('1122', '3'),
            SolutionExample::of('1111', '4'),
            SolutionExample::of('1234', '0'),
            SolutionExample::of('91212129', '9'),
        ];
    }
}