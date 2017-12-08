<?php
namespace AdventOfCode2017\Day02;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day02Part1Solver implements Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        $rows = explode("\r\n", $input);

        $sum = 0;
        foreach ($rows as $row) {
            $items = explode("\t", $row);
            $sum += max($items) - min($items);
        }

        return (string)$sum;
    }

    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                '5	1	9	5
                7	5	3
                2	4	6	8',
                '18'
            ),
        ];
    }
}