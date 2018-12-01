<?php

namespace AdventOfCode2017\Day03;

use AdventOfCode2017\Common\ExamplesProvider;
use AdventOfCode2017\Common\SolutionExample;

class Day03Part2Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of('3', '4'),
            SolutionExample::of('12', '23'),
            SolutionExample::of('26', '54'),
            SolutionExample::of('124', '133'),
            SolutionExample::of('500', '747'),
        ];
    }
}
