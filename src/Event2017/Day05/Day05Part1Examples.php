<?php

namespace AdventOfCode\Event2017\Day05;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day05Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                '0
3
0
1
-3',
                '5'
            ),
        ];
    }
}
