<?php

namespace AdventOfCode\Event2018\Day02;

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
                "abcde
fghij
klmno
pqrst
fguij
axcye
wvxyz",
                "fgij"
            ),
        ];
    }
}
