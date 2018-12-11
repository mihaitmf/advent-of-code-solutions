<?php

namespace AdventOfCode\Event2018\Day09;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day09Part2Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                "9 players; last marble is worth 25 points",
                "22563"
            ),
        ];
    }
}
