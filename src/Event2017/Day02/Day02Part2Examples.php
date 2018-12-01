<?php

namespace AdventOfCode\Event2017\Day02;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day02Part2Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                '5	9	2	8
                9	4	7	3
                3	8	6	5',
                '9'
            ),
        ];
    }
}
