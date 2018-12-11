<?php

namespace AdventOfCode\Event2018\Day11;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day11Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                "18",
                "33,45"
            ),
            SolutionExample::of(
                "42",
                "21,61"
            ),
        ];
    }
}
