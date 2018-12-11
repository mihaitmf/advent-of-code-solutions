<?php

namespace AdventOfCode\Event2018\Day09;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day09Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                "9 players; last marble is worth 25 points",
                "32"
            ),
            SolutionExample::of(
                "10 players; last marble is worth 1618 points",
                "8317"
            ),
            SolutionExample::of(
                "13 players; last marble is worth 7999 points",
                "146373"
            ),
            SolutionExample::of(
                "17 players; last marble is worth 1104 points",
                "2764"
            ),
            SolutionExample::of(
                "21 players; last marble is worth 6111 points",
                "54718"
            ),
            SolutionExample::of(
                "30 players; last marble is worth 5807 points",
                "37305"
            ),
        ];
    }
}
