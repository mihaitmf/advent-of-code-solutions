<?php
namespace AdventOfCode2017\Day03;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day03Part1Solver implements Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        $sqrt = sqrt($input);
        $squareSize = ceil($sqrt);
        if ($squareSize % 2 === 0) {
            $squareSize++;
        }
        $distanceFromVertex = (pow($squareSize, 2) - $input) % ($squareSize - 1);
        $distanceFromMiddleOfEdge = abs($distanceFromVertex - ($squareSize - 1) / 2);
        $distanceToCenter = $distanceFromMiddleOfEdge + ($squareSize - 1) / 2;

        return (string)$distanceToCenter;
    }

    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
//            SolutionExample::of('1', '0'),
            SolutionExample::of('12', '3'),
            SolutionExample::of('23', '2'),
            SolutionExample::of('1024', '31'),
        ];
    }
}