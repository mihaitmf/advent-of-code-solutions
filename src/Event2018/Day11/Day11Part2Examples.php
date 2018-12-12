<?php

namespace AdventOfCode\Event2018\Day11;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day11Part2Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                "18",
                "90,269,16"
            ),
            SolutionExample::of(
                "42",
                "232,251,12"
            ),
        ];
    }
}
