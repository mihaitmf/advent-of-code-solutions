<?php
namespace AdventOfCode2017\Day07;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day07Part1Solver implements Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        $nodes = $this->parseInput($input);

        $isChildNode = [];
        foreach ($nodes as $node) {
            if (!array_key_exists($node->getName(), $isChildNode)) {
                $isChildNode[$node->getName()] = 0;
            }

            foreach ($node->getChildren() as $childNodeName) {
                $isChildNode[$childNodeName] = 1;
            }
        }

        foreach ($isChildNode as $nodeName => $status) {
            if ($status === 0) {
                return $nodeName;
            }
        }
    }

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
        ];
    }

    /**
     * @param string $input
     * @return Node[]
     * @throws \Exception
     */
    private function parseInput($input)
    {
        $rows = explode("\r\n", $input);
        $nodes = [];
        foreach ($rows as $row) {
            if (preg_match('/(\w+)\s\(([0-9]+)\)\s->\s(.+)/', $row, $matches)) {
                $nodes[] = new Node($matches[1], $matches[2], explode(', ', $matches[3]));
            } elseif (preg_match('/(\w+)\s\(([0-9]+)\)/', $row, $matches)) {
                $nodes[] = new Node($matches[1], $matches[2], []);
            } else {
                throw new \Exception("Input parsing exception for row {$row}");
            }
        }
        return $nodes;
    }
}