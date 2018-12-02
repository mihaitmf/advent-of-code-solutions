<?php

namespace AdventOfCode\Event2018\Day01;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day01Part2Examples implements ExamplesProvider
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
                '2'
            ),
//            SolutionExample::of(
//                '+1
//-1',
//                '0'
//            ),
            SolutionExample::of(
                '+3
+3
+4
-2
-4',
                '10'
            ),
            SolutionExample::of(
                '-6
+3
+8
+5
-6',
                '5'
            ),
            SolutionExample::of(
                '+7
+7
-2
-7
-4',
                '14'
            ),
        ];
    }
}
