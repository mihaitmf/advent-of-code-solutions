<?php

namespace AdventOfCode\Event2018\Day06;

use AdventOfCode\Common\InputParser;
use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;

/**
 * http://adventofcode.com/2018/day/6
 *

 */
class Day06Part1Solver implements Solver
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

        /** @var Point[] $coordinatePoints */
        $coordinatePoints = [];

        $minX = null;
        $maxX = 0;
        $minY = null;
        $maxY = 0;

        foreach ($items as $item) {
            $coordinates = explode(", ", $item);
            $x = (int)$coordinates[0];
            $y = (int)$coordinates[1];
            $coordinatePoints[] = new Point($x, $y);

            if ($minX === null) {
                $minX = $x;
            } else {
                $minX = min($minX, $x);
            }
            if ($x > $maxX) {
                $maxX = $x;
            }
            if ($minY === null) {
                $minY = $y;
            } else {
                $minY = min($minY, $y);
            }
            if ($y > $maxY) {
                $maxY = $y;
            }
        }

        /** @var ShortestDistance[][] $distances */
        $distances = [];

        foreach ($coordinatePoints as $coordinatePointIndex => $coordinatePoint) {
            for ($i = $minX; $i < $minX + $maxX; $i++) {
                for ($j = $minY; $j < $minY + $maxY; $j++) {
                    $distance = abs($coordinatePoint->getSum() - $i - $j);
                    if (!isset($distances[$i][$j])
                        || $distance < $distances[$i][$j]->getValue()
                    ) {
                        $distances[$i][$j] = new ShortestDistance($distance, $coordinatePointIndex);
                    } elseif ($distance === $distances[$i][$j]) {
                        $distances[$i][$j] = new ShortestDistance($distance, -1);
                    }
                }
            }
        }

        for ($j = $minY; $j < $minY + $maxY; $j++) {
            for ($i = $minX; $i < $minX + $maxX; $i++) {
                print $distances[$i][$j]->getOwnerCoordinateId() . " ";
            }
            print "\n";
        }
    }
}
