<?php

namespace AdventOfCode\Event2018\Day06;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day06Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                "1, 1
1, 6
8, 3
3, 4
5, 5
8, 9",
                "17"
            ),
        ];
    }
}
