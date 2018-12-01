<?php

namespace AdventOfCode2017\Day04;

use AdventOfCode2017\Common\ExamplesProvider;
use AdventOfCode2017\Common\SolutionExample;

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
