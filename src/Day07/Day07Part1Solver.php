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

        return $this->findRootNodeName($nodes);
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

    /**
     * @param string $input
     * @return Node[]
     * @throws \Exception
     */
    public function parseInput($input)
    {
        $rows = explode("\r\n", $input);
        $nodes = [];
        foreach ($rows as $row) {
            if (preg_match('/(\w+)\s\(([0-9]+)\)\s->\s(.+)/', $row, $matches)) {
                $name = $matches[1];
                $nodes[$name] = new Node($name, $matches[2], explode(', ', $matches[3]));
            } elseif (preg_match('/(\w+)\s\(([0-9]+)\)/', $row, $matches)) {
                $name = $matches[1];
                $nodes[$name] = new Node($name, $matches[2], []);
            } else {
                throw new \Exception("Input parsing exception for row {$row}");
            }
        }
        return $nodes;
    }

    /**
     * @param Node[] $nodes
     * @return string
     * @throws \Exception
     */
    public function findRootNodeName(array $nodes)
    {
        $isChildNode = [];
        foreach ($nodes as $node) {
            if (!array_key_exists($node->getName(), $isChildNode)) {
                $isChildNode[$node->getName()] = 0;
            }

            foreach ($node->getChildrenNames() as $childNodeName) {
                $isChildNode[$childNodeName] = 1;
            }
        }

        foreach ($isChildNode as $nodeName => $status) {
            if ($status === 0) {
                return $nodeName;
            }
        }

        throw new \Exception("No root node found");
    }
}