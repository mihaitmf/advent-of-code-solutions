<?php

namespace AdventOfCode\Event2018\Day03;

use AdventOfCode\Common\InputParser;
use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;

/**
 * http://adventofcode.com/2018/day/3
 *
--- Part Two ---
Amidst the chaos, you notice that exactly one claim doesn't overlap by even a single square inch of fabric with any other claim. If you can somehow draw attention to it, maybe the Elves will be able to make Santa's suit after all!

For example, in the claims above, only claim 3 is intact after all claims are made.

What is the ID of the only claim that doesn't overlap?

Your puzzle answer was 222.
 */
class Day03Part2Solver implements Solver
{
    /**
     * @Inject
     * @var InputParser
     */
    private $inputParser;

    /**
     * @Inject
     * @var Day03Part1Solver
     */
    private $part1Solver;

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $items = $this->inputParser->parseRows($input);

        /** @var array $claimsOnPoints Map<string, int> = <coordinates, claimsCount> */
        $claimsOnPoints = [];

        /** @var ClaimSquare[] $claimsList */
        $claimsList = [];

        foreach ($items as $item) {
            $claimSquare = $this->part1Solver->parseClaimSquare($item);
            list($left, $right, $top, $bottom) = [
                $claimSquare->getLeft(),
                $claimSquare->getRight(),
                $claimSquare->getTop(),
                $claimSquare->getBottom()
            ];

            for ($y = $top; $y <= $bottom; $y++) {
                for ($x = $left; $x <= $right; $x++) {
                    $coordinatesAsString = $x . ',' . $y;

                    if (!array_key_exists($coordinatesAsString, $claimsOnPoints)) {
                        $claimsOnPoints[$coordinatesAsString] = 1;
                    } else {
                        $claimsOnPoints[$coordinatesAsString]++;
                    }
                }
            }

            $claimsList[] = $claimSquare;
        }

        foreach ($claimsList as $claimSquare) {
            list($left, $right, $top, $bottom) = [
                $claimSquare->getLeft(),
                $claimSquare->getRight(),
                $claimSquare->getTop(),
                $claimSquare->getBottom()
            ];

            $isOverlappingClaim = false;

            for ($y = $top; $y <= $bottom; $y++) {
                for ($x = $left; $x <= $right; $x++) {
                    $coordinatesAsString = $x . ',' . $y;

                    if ($claimsOnPoints[$coordinatesAsString] !== 1) {
                        $isOverlappingClaim = true;
                        break 2;
                    }
                }
            }

            if (!$isOverlappingClaim) {
                return (string)$claimSquare->getId();
            }
        }

        throw new \RuntimeException("Solution not found!");
    }
}
