<?php

namespace AdventOfCode\Event2018\Day02;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day02Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                "abcdef
bababc
abbcde
abcccd
aabcdd
abcdee
ababab",
                "12"
            ),
        ];
    }
}
