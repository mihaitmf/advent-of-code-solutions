<?php

namespace AdventOfCode\Event2018\Day11;

use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;

/**
 * http://adventofcode.com/2018/day/11
 *
--- Part Two ---
You discover a dial on the side of the device; it seems to let you select a square of any size, not just 3x3. Sizes from 1x1 to 300x300 are supported.

Realizing this, you now must find the square of any size with the largest total power. Identify this square by including its size as a third parameter after the top-left coordinate: a 9x9 square with a top-left corner of 3,5 is identified as 3,5,9.

For example:

For grid serial number 18, the largest total square (with a total power of 113) is 16x16 and has a top-left corner of 90,269, so its identifier is 90,269,16.
For grid serial number 42, the largest total square (with a total power of 119) is 12x12 and has a top-left corner of 232,251, so its identifier is 232,251,12.
What is the X,Y,size identifier of the square with the largest total power?

Your puzzle answer was 229,192,11.
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

        // TODO find a better solution than this "shortcut" to start analysing from square size = 16
        for ($squareSize = 16; $squareSize > 0; $squareSize--) {
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
