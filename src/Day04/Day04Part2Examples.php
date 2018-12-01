<?php

namespace AdventOfCode2017\Day04;

use AdventOfCode2017\Common\ExamplesProvider;
use AdventOfCode2017\Common\SolutionExample;

class Day04Part2Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                'abcde fghij
abcde xyz ecdab
a ab abc abd abf abj
iiii oiii ooii oooi oooo
oiii ioii iioi iiio',
                '3'
            ),
        ];
    }
}
