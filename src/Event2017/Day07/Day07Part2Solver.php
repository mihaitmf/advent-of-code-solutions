<?php

namespace AdventOfCode\Event2017\Day07;

use AdventOfCode\Common\Solver;
use Exception;

/**
http://adventofcode.com/2017/day/7

--- Part Two ---

The programs explain the situation: they can't get down. Rather, they could get down, if they weren't expending all of their energy trying to keep the tower balanced. Apparently, one program has the wrong weight, and until it's fixed, they're stuck here.

For any program holding a disc, each program standing on that disc forms a sub-tower. Each of those sub-towers are supposed to be the same weight, or the disc itself isn't balanced. The weight of a tower is the sum of the weights of the programs in that tower.

In the example above, this means that for ugml's disc to be balanced, gyxo, ebii, and jptl must all have the same weight, and they do: 61.

However, for tknk to be balanced, each of the programs standing on its disc and all programs above it must each match. This means that the following sums must all be the same:

ugml + (gyxo + ebii + jptl) = 68 + (61 + 61 + 61) = 251
padx + (pbga + havc + qoyq) = 45 + (66 + 66 + 66) = 243
fwft + (ktlj + cntj + xhth) = 72 + (57 + 57 + 57) = 243
As you can see, tknk's disc is unbalanced: ugml's stack is heavier than the other two. Even though the nodes above ugml are balanced, ugml itself is too heavy: it needs to be 8 units lighter for its stack to weigh 243 and keep the towers balanced. If this change were made, its weight would be 60.

Given that exactly one program is the wrong weight, what would its weight need to be to balance the entire tower?

Although it hasn't changed, you can still get your puzzle input.

Your puzzle answer was 1226.
 */
class Day07Part2Solver implements Solver
{
    const IMBALANCE_MESSAGE_DELIMITER = 'Imbalance found:';

    /** @var Day07Part1Solver */
    private $part1Solver;

    public function __construct()
    {
        $this->part1Solver = new Day07Part1Solver();
    }

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $nodes = $this->part1Solver->parseInput($input);

        $rootName = $this->part1Solver->findRootNodeName($nodes);

        try {
            $this->calculateBranchWeight($nodes, $nodes[$rootName]);

        } catch (Exception $exception) {
            $imbalanceMessage = explode(self::IMBALANCE_MESSAGE_DELIMITER, $exception->getMessage());

            return $imbalanceMessage[1];
        }
    }

    /**
     * @param Node[] $nodes
     * @param Node $currentNode
     *
     * @return int
     * @throws Exception
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

            throw new Exception(self::IMBALANCE_MESSAGE_DELIMITER . $newNodeWeight);
        }

        return $currentBranchWeight + $sumOfChildrenBranchWeights;
    }

    /**
     * @param int $sumOfChildrenBranchWeights
     * @param array $childrenBranchWeights Map<string, int>
     *
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
