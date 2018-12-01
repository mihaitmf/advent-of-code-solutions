<?php

namespace AdventOfCode\Event2017\Day07;

use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\SolutionExample;

class Day07Part1Examples implements ExamplesProvider
{
    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                'pbga (66)
xhth (57)
ebii (61)
havc (66)
ktlj (57)
fwft (72) -> ktlj, cntj, xhth
qoyq (66)
padx (45) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
jptl (61)
ugml (68) -> gyxo, ebii, jptl
gyxo (61)
cntj (57)',
                'tknk'
            ),
            SolutionExample::of(
                'pbga (66)
havc (66) -> aaaa, bbbb
ktlj (57)
fwft (72) -> ktlj, cntj
qoyq (66) -> cccc
padx (45) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
ugml (68) -> gyxo
gyxo (61)
aaaa (1)
bbbb (2)
cccc (3)
zzzz (4) -> tknk
cntj (57)',
                'zzzz'
            ),
        ];
    }
}
