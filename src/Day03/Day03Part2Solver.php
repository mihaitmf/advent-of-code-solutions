<?php
namespace AdventOfCode2017\Day03;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day03Part2Solver implements Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        //TODO
    }

    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of('3', '4'),
            SolutionExample::of('12', '23'),
            SolutionExample::of('26', '54'),
            SolutionExample::of('124', '133'),
            SolutionExample::of('500', '747'),
        ];
    }
}