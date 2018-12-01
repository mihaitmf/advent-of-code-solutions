<?php

namespace AdventOfCode2017\Day03;

use AdventOfCode2017\Common\ExamplesProvider;
use AdventOfCode2017\Common\SolutionExample;

class Day03Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
//            SolutionExample::of('1', '0'),
            SolutionExample::of('12', '3'),
            SolutionExample::of('23', '2'),
            SolutionExample::of('1024', '31'),
        ];
    }
}
