<?php

namespace AdventOfCode\Event2018\Day08;

use AdventOfCode\Common\InputParser;
use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;

/**
 * http://adventofcode.com/2018/day/8
 *
--- Day 8: Memory Maneuver ---
The sleigh is much easier to pull than you'd expect for something its weight. Unfortunately, neither you nor the Elves know which way the North Pole is from here.

You check your wrist device for anything that might help. It seems to have some kind of navigation system! Activating the navigation system produces more bad news: "Failed to start navigation system. Could not read software license file."

The navigation system's license file consists of a list of numbers (your puzzle input). The numbers define a data structure which, when processed, produces some kind of tree that can be used to calculate the license number.

The tree is made up of nodes; a single, outermost node forms the tree's root, and it contains all other nodes in the tree (or contains nodes that contain nodes, and so on).

Specifically, a node consists of:

A header, which is always exactly two numbers:
The quantity of child nodes.
The quantity of metadata entries.
Zero or more child nodes (as specified in the header).
One or more metadata entries (as specified in the header).
Each child node is itself a node that has its own header, child nodes, and metadata. For example:

2 3 0 3 10 11 12 1 1 0 1 99 2 1 1 2
A----------------------------------
B----------- C-----------
D-----
In this example, each node of the tree is also marked with an underline starting with a letter for easier identification. In it, there are four nodes:

A, which has 2 child nodes (B, C) and 3 metadata entries (1, 1, 2).
B, which has 0 child nodes and 3 metadata entries (10, 11, 12).
C, which has 1 child node (D) and 1 metadata entry (2).
D, which has 0 child nodes and 1 metadata entry (99).
The first check done on the license file is to simply add up all of the metadata entries. In this example, that sum is 1+1+2+10+11+12+2+99=138.

What is the sum of all metadata entries?

Your puzzle answer was 43996.
 */
class Day08Part1Solver implements Solver
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

        return (string)$this->processStack(new Node((int)$items[0], (int)$items[1]), 1, $items, [], 0);
    }

    /**
     * @param Node $node
     * @param int $i
     * @param string[] $items
     * @param Node[] $stack
     * @param int $metadataValuesSum
     *
     * @return int
     */
    private function processStack(
        $node,
        $i,
        $items,
        $stack,
        $metadataValuesSum
    ) {
        // if we found all children of $node
        if ($node->getChildrenCount() === 0) {
            $nodeMetadataCount = $node->getMetadataCount();

            while ($nodeMetadataCount > 0) {
                $metadataValuesSum += (int)$items[++$i];
                $nodeMetadataCount--;
            }

            if ($stack === []) {
                return $metadataValuesSum;
            }

            $parentNode = array_pop($stack);
            $parentNode->decrementChildrenCount();

            return $this->processStack($parentNode, $i, $items, $stack, $metadataValuesSum);
        }

        // we didn't find all the children of $node, move forward to process next node
        $stack[] = $node;

        return $this->processStack(
            new Node((int)$items[$i + 1], (int)$items[$i + 2]),
            $i + 2,
            $items,
            $stack,
            $metadataValuesSum
        );
    }
}
