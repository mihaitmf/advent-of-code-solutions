<?php

namespace AdventOfCode\Event2017\Day04;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day04Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                'aa bb cc dd ee
aa bb cc dd aa
aa bb cc dd aaa',
                '2'
            ),
        ];
    }
}
