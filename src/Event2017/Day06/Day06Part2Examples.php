<?php

namespace AdventOfCode\Event2017\Day06;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day06Part2Examples implements ExamplesProvider
{
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
