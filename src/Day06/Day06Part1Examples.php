<?php

namespace AdventOfCode2017\Day06;

use AdventOfCode2017\Common\ExamplesProvider;
use AdventOfCode2017\Common\SolutionExample;

class Day06Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                '0	2	7	0',
                '5'
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
                '6'
            ),
        ];
    }
}
