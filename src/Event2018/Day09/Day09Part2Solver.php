<?php

namespace AdventOfCode\Event2018\Day09;

use AdventOfCode\Common\Solver;

/**
 * http://adventofcode.com/2018/day/9
 *

 */
class Day09Part2Solver implements Solver
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
        $lastMarbleNumber = (int)$matches[2] * 100;

        /** @var array Map<int, int> = <playerIndex, score> $scorePerPlayer */
        $scorePerPlayer = [];

        $marbleTurn = 1;
        $playerIndex = 1;

        $currentMarble = new Marble(0);
        $currentMarble->setNext($currentMarble)
            ->setPrev($currentMarble);

        while ($marbleTurn <= $lastMarbleNumber) {
            if ($marbleTurn % 23 === 0) {
                $moveLeftSteps = 7;
                $additionalMarble = $currentMarble;
                while ($moveLeftSteps > 0) {
                    $additionalMarble = $additionalMarble->getPrev();
                    $moveLeftSteps--;
                }

                $currentTurnScore = $marbleTurn + $additionalMarble->getValue();

                // remove the marble from the circle
                $currentMarble = $additionalMarble->getNext();
                $additionalMarble->getPrev()->setNext($currentMarble);
                $currentMarble->setPrev($additionalMarble->getPrev());

                if (!array_key_exists($playerIndex, $scorePerPlayer)) {
                    $scorePerPlayer[$playerIndex] = $currentTurnScore;
                } else {
                    $scorePerPlayer[$playerIndex] += $currentTurnScore;
                }

            } else {
                $leftSideMarble = $currentMarble->getNext();
                $rightSideMarble = $currentMarble->getNext()->getNext();

                // insert the new marble in the circle
                $newMarble = (new Marble($marbleTurn))
                    ->setPrev($leftSideMarble)
                    ->setNext($rightSideMarble);
                $leftSideMarble->setNext($newMarble);
                $rightSideMarble->setPrev($newMarble);

                $currentMarble = $newMarble;
            }

            if ($playerIndex === $playersNumber) {
                $playerIndex = 1;
            } else {
                $playerIndex++;
            }

            $marbleTurn++;
        }

        return (string)max($scorePerPlayer);
    }
}
