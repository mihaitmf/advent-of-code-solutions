<?php

namespace AdventOfCode\Event2017\Day03;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

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
