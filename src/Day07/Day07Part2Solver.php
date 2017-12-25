<?php
namespace AdventOfCode2017\Day07;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day07Part2Solver implements Solver
{
    const IMBALANCE_MESSAGE_DELIMITER = 'Imbalance found:';

    /** @var Day07Part1Solver */
    private $part1Solver;

    public function __construct(Day07Part1Solver $part1Solver)
    {
        $this->part1Solver = $part1Solver;
    }

    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        $nodes = $this->part1Solver->parseInput($input);

        $rootName = $this->part1Solver->findRootNodeName($nodes);

        try {
            $this->calculateBranchWeight($nodes, $nodes[$rootName]);
        } catch (\Exception $exception) {
            $imbalanceMessage = explode(self::IMBALANCE_MESSAGE_DELIMITER, $exception->getMessage());
            return (int)$imbalanceMessage[1];
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
                '60'
            ),
        ];
    }

    /**
     * @param Node[] $nodes
     * @param Node $currentNode
     * @return int
     * @throws \Exception
     */
    private function calculateBranchWeight(array $nodes, Node $currentNode)
    {
        $currentBranchWeight = $currentNode->getWeight();

        if (count($currentNode->getChildrenNames()) === 0) {
            return $currentBranchWeight;
        }

        $sumOfChildrenBranchWeights = 0;
        $childrenBranchWeights = [];
        foreach ($currentNode->getChildrenNames() as $childName) {
            $currentChildBranchWeight = $this->calculateBranchWeight($nodes, $nodes[$childName]);

            $childrenBranchWeights[$childName] = $currentChildBranchWeight;
            $sumOfChildrenBranchWeights += $currentChildBranchWeight;
        }

        list($imbalancedNodeName, $balancedNodeName) = $this->findImbalancedNode(
            $sumOfChildrenBranchWeights,
            $childrenBranchWeights
        );

        if ($imbalancedNodeName !== null) {
            $newNodeWeight = $nodes[$imbalancedNodeName]->getWeight() - $childrenBranchWeights[$imbalancedNodeName]
                + $childrenBranchWeights[$balancedNodeName];
            throw new \Exception(self::IMBALANCE_MESSAGE_DELIMITER . $newNodeWeight);
        }

        return $currentBranchWeight + $sumOfChildrenBranchWeights;
    }

    /**
     * @param int $sumOfChildrenBranchWeights
     * @param array $childrenBranchWeights
     * @return array
     */
    private function findImbalancedNode($sumOfChildrenBranchWeights, array $childrenBranchWeights)
    {
        $average = $sumOfChildrenBranchWeights / count($childrenBranchWeights);
        $maxDiff = 0;
        $imbalancedNodeName = null;
        $balancedNodeName = null;

        foreach ($childrenBranchWeights as $childName => $childBranchWeight) {
            $diffToAverage = abs($childBranchWeight - $average);
            if ($diffToAverage > $maxDiff) {
                $maxDiff = $diffToAverage;
                $imbalancedNodeName = $childName;
            } else {
                $balancedNodeName = $childName;
            }
        }

        return [$imbalancedNodeName, $balancedNodeName];
    }
}