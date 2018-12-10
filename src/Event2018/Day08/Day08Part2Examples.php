<?php

namespace AdventOfCode\Event2018\Day08;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day08Part2Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                "2 3 0 3 10 11 12 1 1 0 1 99 2 1 1 2",
                "66"
            ),
        ];
    }
}
