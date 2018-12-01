<?php

namespace AdventOfCode2017\Day01;

use AdventOfCode2017\Common\ExamplesProvider;
use AdventOfCode2017\Common\SolutionExample;

class Day01Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of('1122', '3'),
            SolutionExample::of('1111', '4'),
            SolutionExample::of('1234', '0'),
            SolutionExample::of('91212129', '9'),
        ];
    }
}
