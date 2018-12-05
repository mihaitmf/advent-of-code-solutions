<?php

namespace AdventOfCode\Event2018\Day05;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day05Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                "aA",
                "0"
            ),
            SolutionExample::of(
                "abBA",
                "0"
            ),
            SolutionExample::of(
                "abAB",
                "4"
            ),
            SolutionExample::of(
                "aabAAB",
                "6"
            ),
            SolutionExample::of(
                "dabAcCaCBAcCcaDA",
                "10"
            ),
        ];
    }
}
