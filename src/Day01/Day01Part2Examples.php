<?php

namespace AdventOfCode2017\Day01;

use AdventOfCode2017\Common\ExamplesProvider;
use AdventOfCode2017\Common\SolutionExample;

class Day01Part2Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of('1212', '6'),
            SolutionExample::of('1221', '0'),
            SolutionExample::of('123425', '4'),
            SolutionExample::of('123123', '12'),
            SolutionExample::of('12131415', '4'),
        ];
    }
}
