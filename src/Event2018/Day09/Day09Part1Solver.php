<?php

namespace AdventOfCode\Event2018\Day09;

use AdventOfCode\Common\Solver;

/**
 * http://adventofcode.com/2018/day/9
 *

 */
class Day09Part1Solver implements Solver
{
    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $matches = [];
        $matchResult = preg_match("/^(\d+) players; last marble is worth (\d+) points$/", $input, $matches);

        if ($matchResult !== 1) {
            throw new \RuntimeException("Invalid input, could not match pattern");
        }

        $playersNumber = (int)$matches[1];
        $lastMarbleNumber = (int)$matches[2];

        /** @var array Map<int, int> = <position, marbleNumber> $circle */
        $circle = [0];

        /** @var array Map<int, int> = <playerIndex, score> $scorePerPlayer */
        $scorePerPlayer = [];

        $maxScore = 0;
        $currentMarblePosition = 0;
        $marbleTurn = 1;
        $playerIndex = 1;

        while ($marbleTurn <= $lastMarbleNumber) {
            if ($playerIndex > $playersNumber) {
                $playerIndex = 1;
            }

            $circleSize = count($circle);

            if ($marbleTurn % 23 === 0) {
                $extraMarblePosition = $currentMarblePosition - 7;
                if ($extraMarblePosition < 0) {
                    $extraMarblePosition += $circleSize;
                }

                $currentTurnScore = $marbleTurn + $circle[$extraMarblePosition];

                // remove the marble in the circle
                array_splice($circle, $extraMarblePosition, 1);

                $currentMarblePosition = $extraMarblePosition;

                if (!array_key_exists($playerIndex, $scorePerPlayer)) {
                    $scorePerPlayer[$playerIndex] = $currentTurnScore;
                } else {
                    $scorePerPlayer[$playerIndex] += $currentTurnScore;
                }

                $maxScore = max($maxScore, $scorePerPlayer[$playerIndex]);

            } else {
                $newMarbleInsertPosition = $currentMarblePosition + 2;
                if ($newMarbleInsertPosition > $circleSize) {
                    $newMarbleInsertPosition -= $circleSize;
                }

                // insert the new marble in the circle
                array_splice($circle, $newMarbleInsertPosition, 0, $marbleTurn);

                $currentMarblePosition = $newMarbleInsertPosition;
            }

            $playerIndex++;
            $marbleTurn++;
        }

        return (string)$maxScore;
    }
}
