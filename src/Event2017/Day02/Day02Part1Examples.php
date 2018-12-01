<?php

namespace AdventOfCode\Event2017\Day02;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day02Part1Examples implements ExamplesProvider
{
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
