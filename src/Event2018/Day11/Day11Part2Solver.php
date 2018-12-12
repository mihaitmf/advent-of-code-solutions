<?php

namespace AdventOfCode\Event2018\Day11;

use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;

/**
 * http://adventofcode.com/2018/day/11
 *

 */
class Day11Part2Solver implements Solver
{
    const MAX_CELL_POWER = 4;

    /**
     * @Inject
     * @var Day11Part1Solver
     */
    private $part1Solver;

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $serialNumber = (int)$input;

        $cellsPowerMatrix = $this->part1Solver->calculateCellsPowerMatrix($serialNumber);

        $maxSquareTotalPower = null;
        $maxSquareTotalPowerCoordinates = "";

        for ($squareSize = 50; $squareSize > 0; $squareSize--) {
            $topLeftCellLimit = 301 - $squareSize;

            for ($x = 1; $x <= $topLeftCellLimit; $x++) {
                for ($y = 1; $y <= $topLeftCellLimit; $y++) {
                    $squareTotalPower = $this->part1Solver->calculateSquareTotalPower($cellsPowerMatrix, $x, $y, $squareSize);

                    if ($maxSquareTotalPower === null) {
                        $maxSquareTotalPower = $squareTotalPower;

                    } elseif ($squareTotalPower > $maxSquareTotalPower) {
                        $maxSquareTotalPower = $squareTotalPower;
                        $maxSquareTotalPowerCoordinates = $x . ',' . $y . ',' . $squareSize;

                        echo $maxSquareTotalPowerCoordinates . "\t" . $maxSquareTotalPower . "\n";
                    }
                }
            }

            if ($maxSquareTotalPower >= self::MAX_CELL_POWER * $squareSize * $squareSize) {
                return $maxSquareTotalPowerCoordinates;
            }

            echo $squareSize . "\n";
        }

        return $maxSquareTotalPowerCoordinates;
    }
}
