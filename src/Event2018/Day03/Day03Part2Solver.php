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

        /** @var ClaimMatrix[] $claimsList */
        $claimsList = [];
        $nonOverlappingClaims = [];
        $countClaims = count($items);

        foreach ($items as $item) {
            $currentClaim = $this->part1Solver->parseClaimMatrix($item);

            foreach ($claimsList as $previousClaim) {
                $maxLeft = max($previousClaim->getLeft(), $currentClaim->getLeft());
                $minRight = min($previousClaim->getRight(), $currentClaim->getRight());
                $maxTop = max($previousClaim->getTop(), $currentClaim->getTop());
                $minBottom = min($previousClaim->getBottom(), $currentClaim->getBottom());

                if (!($maxLeft <= $minRight && $maxTop <= $minBottom)) {
                    $currentClaimId = $currentClaim->getId();
                    if (!array_key_exists($currentClaimId, $nonOverlappingClaims)) {
                        $nonOverlappingClaims[$currentClaimId] = 1;
                    } else {
                        $nonOverlappingClaims[$currentClaimId]++;
                        if ($nonOverlappingClaims[$currentClaimId] === $countClaims - 1) {
                            return $currentClaimId;
                        }
                    }
                    $previousClaimId = $previousClaim->getId();
                    if (!array_key_exists($previousClaimId, $nonOverlappingClaims)) {
                        $nonOverlappingClaims[$previousClaimId] = 1;
                    } else {
                        $nonOverlappingClaims[$previousClaimId]++;
                        if ($nonOverlappingClaims[$previousClaimId] === $countClaims - 1) {
                            return $previousClaimId;
                        }
                    }
                }
            }

            $claimsList[] = $currentClaim;
        }
    }
}
