<?php

namespace AdventOfCode2017\Day07;

use AdventOfCode2017\Common\ExamplesProvider;
use AdventOfCode2017\Common\SolutionExample;

class Day07Part2Examples implements ExamplesProvider
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
                '60' // ugml
            ),
            SolutionExample::of(
                'pbga (66)
havc (44) -> aaaa, bbbb
ktlj (57)
fwft (129) -> ktlj, cntj
qoyq (46) -> cccc
padx (45) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
ugml (68) -> gyxo
gyxo (183)
aaaa (11)
bbbb (11)
cccc (20)
zzzz (4) -> tknk
cntj (57)',
                '60' // ugml
            ),
            SolutionExample::of(
                'pbga (66)
havc (44) -> aaaa, bbbb
ktlj (57)
fwft (129) -> ktlj, cntj
qoyq (46) -> cccc
padx (45) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
ugml (60) -> gyxo
gyxo (183)
aaaa (20)
bbbb (11)
cccc (20)
cntj (57)',
                '11' // aaaa
            ),
            SolutionExample::of(
                'pbga (66)
havc (44) -> aaaa, bbbb
ktlj (57)
fwft (129) -> ktlj, cntj
qoyq (46) -> cccc
padx (40) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
ugml (60) -> gyxo
gyxo (183)
aaaa (11)
bbbb (11)
cccc (20)
cntj (57)',
                '45' // padx
            ),
        ];
    }
}
