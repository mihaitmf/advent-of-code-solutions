<?php

namespace AdventOfCode\Event2018\Day13;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day13Part2Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                "/>-<\  
|   |  
| /<+-\
| | | v
\>+</ |
  |   ^
  \<->/",
                "6,4"
            ),
        ];
    }
}
