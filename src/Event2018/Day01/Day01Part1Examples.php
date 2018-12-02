<?php

namespace AdventOfCode\Event2018\Day01;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day01Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                '+1
-2
+3
+1',
                '3'
            ),
            SolutionExample::of(
                '+1
+1
+1',
                '3'
            ),
            SolutionExample::of(
                '+1
+1
-2',
                '0'
            ),
            SolutionExample::of(
                '-1
-2
-3',
                '-6'
            ),
        ];
    }
}
