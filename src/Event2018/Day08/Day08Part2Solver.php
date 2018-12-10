<?php

namespace AdventOfCode\Event2018\Day08;

use AdventOfCode\Common\InputParser;
use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;

/**
 * http://adventofcode.com/2018/day/8
 *
--- Part Two ---
The second check is slightly more complicated: you need to find the value of the root node (A in the example above).

The value of a node depends on whether it has child nodes.

If a node has no child nodes, its value is the sum of its metadata entries. So, the value of node B is 10+11+12=33, and the value of node D is 99.

However, if a node does have child nodes, the metadata entries become indexes which refer to those child nodes. A metadata entry of 1 refers to the first child node, 2 to the second, 3 to the third, and so on. The value of this node is the sum of the values of the child nodes referenced by the metadata entries. If a referenced child node does not exist, that reference is skipped. A child node can be referenced multiple time and counts each time it is referenced. A metadata entry of 0 does not refer to any child node.

For example, again using the above nodes:

Node C has one metadata entry, 2. Because node C has only one child node, 2 references a child node which does not exist, and so the value of node C is 0.
Node A has three metadata entries: 1, 1, and 2. The 1 references node A's first child node, B, and the 2 references node A's second child node, C. Because node B has a value of 33 and node C has a value of 0, the value of node A is 33+33+0=66.
So, in this example, the value of the root node is 66.

What is the value of the root node?

Your puzzle answer was 35189.
 */
class Day08Part2Solver implements Solver
{
    /**
     * @Inject
     * @var InputParser
     */
    private $inputParser;

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $items = $this->inputParser->parseItemsBySpace($input);

        ini_set('xdebug.max_nesting_level', 4000);

        return (string)$this->processStack(new Node((int)$items[0], (int)$items[1]), 1, $items, []);
    }

    /**
     * @param Node $node
     * @param int $i
     * @param string[] $items
     * @param Node[] $stack
     *
     * @return int
     */
    private function processStack(
        $node,
        $i,
        $items,
        $stack
    ) {
        // if $node is a leaf node
        if ($node->getChildrenCount() === 0) {
            $nodeMetadataCount = $node->getMetadataCount();
            $nodeValue = 0;

            while ($nodeMetadataCount > 0) {
                $nodeValue += (int)$items[++$i];
                $nodeMetadataCount--;
            }

            $parentNode = array_pop($stack);
            $parentNode->addChildValue($nodeValue);

            return $this->processStack($parentNode, $i, $items, $stack);
        }

        // if we found all children of $node
        if ($node->getChildrenCount() === count($node->getChildrenValues())) {
            $nodeMetadataCount = $node->getMetadataCount();
            $nodeChildrenValues = $node->getChildrenValues();
            $nodeValue = 0;

            while ($nodeMetadataCount > 0) {
                $childIndex = (int)$items[++$i] - 1;
                if (array_key_exists($childIndex, $nodeChildrenValues)) {
                    $nodeValue += $nodeChildrenValues[$childIndex];
                }
                $nodeMetadataCount--;
            }

            if ($stack === []) {
                return $nodeValue;
            }

            $parentNode = array_pop($stack);
            $parentNode->addChildValue($nodeValue);

            return $this->processStack($parentNode, $i, $items, $stack);
        }

        // we didn't find all the node's children, move forward
        $stack[] = $node;

        return $this->processStack(
            new Node((int)$items[$i + 1], (int)$items[$i + 2]),
            $i + 2,
            $items,
            $stack
        );
    }
}
