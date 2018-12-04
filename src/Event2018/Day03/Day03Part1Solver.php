<?php

namespace AdventOfCode\Event2018\Day03;

use AdventOfCode\Common\InputParser;
use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;
use RuntimeException;

/**
 * http://adventofcode.com/2018/day/3
 *
--- Day 3: No Matter How You Slice It ---
The Elves managed to locate the chimney-squeeze prototype fabric for Santa's suit (thanks to someone who helpfully wrote its box IDs on the wall of the warehouse in the middle of the night). Unfortunately, anomalies are still affecting them - nobody can even agree on how to cut the fabric.

The whole piece of fabric they're working on is a very large square - at least 1000 inches on each side.

Each Elf has made a claim about which area of fabric would be ideal for Santa's suit. All claims have an ID and consist of a single rectangle with edges parallel to the edges of the fabric. Each claim's rectangle is defined as follows:

The number of inches between the left edge of the fabric and the left edge of the rectangle.
The number of inches between the top edge of the fabric and the top edge of the rectangle.
The width of the rectangle in inches.
The height of the rectangle in inches.
A claim like #123 @ 3,2: 5x4 means that claim ID 123 specifies a rectangle 3 inches from the left edge, 2 inches from the top edge, 5 inches wide, and 4 inches tall. Visually, it claims the square inches of fabric represented by # (and ignores the square inches of fabric represented by .) in the diagram below:

...........
...........
...#####...
...#####...
...#####...
...#####...
...........
...........
...........
The problem is that many of the claims overlap, causing two or more claims to cover part of the same areas. For example, consider the following claims:

#1 @ 1,3: 4x4
#2 @ 3,1: 4x4
#3 @ 5,5: 2x2
Visually, these claim the following areas:

........
...2222.
...2222.
.11XX22.
.11XX22.
.111133.
.111133.
........
The four square inches marked with X are claimed by both 1 and 2. (Claim 3, while adjacent to the others, does not overlap either of them.)

If the Elves all proceed with their own plans, none of them will have enough fabric. How many square inches of fabric are within two or more claims?

Your puzzle answer was 105071.
 */
class Day03Part1Solver implements Solver
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
        $items = $this->inputParser->parseRows($input);

        /** @var ClaimMatrix[] $claimsList */
        $claimsList = [];
        $overlapPoints = []; // only use the keys, store in keys because searching is faster than in values
        $countOverlappingPoints = 0;

        foreach ($items as $item) {
            $currentClaim = $this->parseClaimMatrix($item);

            foreach ($claimsList as $previousClaim) {
                $maxLeft = max($previousClaim->getLeft(), $currentClaim->getLeft());
                $minRight = min($previousClaim->getRight(), $currentClaim->getRight());
                $maxTop = max($previousClaim->getTop(), $currentClaim->getTop());
                $minBottom = min($previousClaim->getBottom(), $currentClaim->getBottom());

                // if overlapping claims
                if ($maxLeft <= $minRight && $maxTop <= $minBottom) {
                    for ($i = $maxLeft; $i <= $minRight; $i++ ) {
                        for ($j = $maxTop; $j <= $minBottom; $j++ ) {
                            $point = $i . 'x' . $j;
                            if (!array_key_exists($point, $overlapPoints)) {
                                $overlapPoints[$point] = 1;
                                $countOverlappingPoints++;
                            }
                        }
                    }
                }
            }

            $claimsList[] = $currentClaim;
        }

        return (string)$countOverlappingPoints;
    }

    /**
     * @param string $item
     *
     * @return ClaimMatrix
     */
    private function parseClaimMatrix($item)
    {
        $matches = [];
        $matchResult = preg_match("/^#(\d+)\s@\s(\d+),(\d+):\s(\d+)x(\d+)$/", $item, $matches);
        if ($matchResult !== 1) {
            throw new RuntimeException("Could not parse claim");
        }

        return new ClaimMatrix(
            $matches[1],
            $matches[2],
            $matches[2] + $matches[4] - 1,
            $matches[3],
            $matches[3] + $matches[5] - 1
        );
    }
}
