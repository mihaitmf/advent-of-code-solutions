<?php

namespace AdventOfCode\Event2018\Day10;

use AdventOfCode\Common\InputParser;
use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;
use RuntimeException;

/**
 * http://adventofcode.com/2018/day/10
 *
--- Day 10: The Stars Align ---
It's no use; your navigation system simply isn't capable of providing walking directions in the arctic circle, and certainly not in 1018.

The Elves suggest an alternative. In times like these, North Pole rescue operations will arrange points of light in the sky to guide missing Elves back to base. Unfortunately, the message is easy to miss: the points move slowly enough that it takes hours to align them, but have so much momentum that they only stay aligned for a second. If you blink at the wrong time, it might be hours before another message appears.

You can see these points of light floating in the distance, and record their position in the sky and their velocity, the relative change in position per second (your puzzle input). The coordinates are all given from your perspective; given enough time, those positions and velocities will move the points into a cohesive message!

Rather than wait, you decide to fast-forward the process and calculate what the points will eventually spell.

For example, suppose you note the following points:

position=< 9,  1> velocity=< 0,  2>
position=< 7,  0> velocity=<-1,  0>
position=< 3, -2> velocity=<-1,  1>
position=< 6, 10> velocity=<-2, -1>
position=< 2, -4> velocity=< 2,  2>
position=<-6, 10> velocity=< 2, -2>
position=< 1,  8> velocity=< 1, -1>
position=< 1,  7> velocity=< 1,  0>
position=<-3, 11> velocity=< 1, -2>
position=< 7,  6> velocity=<-1, -1>
position=<-2,  3> velocity=< 1,  0>
position=<-4,  3> velocity=< 2,  0>
position=<10, -3> velocity=<-1,  1>
position=< 5, 11> velocity=< 1, -2>
position=< 4,  7> velocity=< 0, -1>
position=< 8, -2> velocity=< 0,  1>
position=<15,  0> velocity=<-2,  0>
position=< 1,  6> velocity=< 1,  0>
position=< 8,  9> velocity=< 0, -1>
position=< 3,  3> velocity=<-1,  1>
position=< 0,  5> velocity=< 0, -1>
position=<-2,  2> velocity=< 2,  0>
position=< 5, -2> velocity=< 1,  2>
position=< 1,  4> velocity=< 2,  1>
position=<-2,  7> velocity=< 2, -2>
position=< 3,  6> velocity=<-1, -1>
position=< 5,  0> velocity=< 1,  0>
position=<-6,  0> velocity=< 2,  0>
position=< 5,  9> velocity=< 1, -2>
position=<14,  7> velocity=<-2,  0>
position=<-3,  6> velocity=< 2, -1>
Each line represents one point. Positions are given as <X, Y> pairs: X represents how far left (negative) or right (positive) the point appears, while Y represents how far up (negative) or down (positive) the point appears.

At 0 seconds, each point has the position given. Each second, each point's velocity is added to its position. So, a point with velocity <1, -2> is moving to the right, but is moving upward twice as quickly. If this point's initial position were <3, 9>, after 3 seconds, its position would become <6, 3>.

Over time, the points listed above would move like this:

Initially:
........#.............
................#.....
.........#.#..#.......
......................
#..........#.#.......#
...............#......
....#.................
..#.#....#............
.......#..............
......#...............
...#...#.#...#........
....#..#..#.........#.
.......#..............
...........#..#.......
#...........#.........
...#.......#..........

After 1 second:
......................
......................
..........#....#......
........#.....#.......
..#.........#......#..
......................
......#...............
....##.........#......
......#.#.............
.....##.##..#.........
........#.#...........
........#...#.....#...
..#...........#.......
....#.....#.#.........
......................
......................

After 2 seconds:
......................
......................
......................
..............#.......
....#..#...####..#....
......................
........#....#........
......#.#.............
.......#...#..........
.......#..#..#.#......
....#....#.#..........
.....#...#...##.#.....
........#.............
......................
......................
......................

After 3 seconds:
......................
......................
......................
......................
......#...#..###......
......#...#...#.......
......#...#...#.......
......#####...#.......
......#...#...#.......
......#...#...#.......
......#...#...#.......
......#...#..###......
......................
......................
......................
......................

After 4 seconds:
......................
......................
......................
............#.........
........##...#.#......
......#.....#..#......
.....#..##.##.#.......
.......##.#....#......
...........#....#.....
..............#.......
....#......#...#......
.....#.....##.........
...............#......
...............#......
......................
......................
After 3 seconds, the message appeared briefly: HI. Of course, your message will be much longer and will take many more seconds to appear.

What message will eventually appear in the sky?

Your puzzle answer was HRPHBRKG.
 */
class Day10Part1Solver implements Solver
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
        /**
         * @var Point[] $points
         * @var int[] $pointsPositions Map<string, int>
         */
        list($points, $pointsPositions) = $this->parseInput($input);

        while (!$this->arePointsAligned($points, $pointsPositions)) {
            $this->updatePointsPositions($points, $pointsPositions);
        }

        $this->printPoints($points, $pointsPositions);
    }

    /**
     * @param $input
     *
     * @return array [Point[], Map<string, int>]
     */
    public function parseInput($input)
    {
        $points = [];
        $pointsPositions = [];

        $items = $this->inputParser->parseRows($input);

        foreach ($items as $item) {
            $matches = [];
            $matchResult = preg_match("/^position=<([\s-]*\d+), ([\s-]*\d+)> velocity=<([\s-]*\d+), ([\s-]*\d+)>$/", $item, $matches);

            if ($matchResult !== 1) {
                throw new RuntimeException("Could not parse input");
            }

            $positionX = (int)$matches[1];
            $positionY = (int)$matches[2];

            $points[] = new Point(
                $positionX,
                $positionY,
                (int)$matches[3],
                (int)$matches[4]
            );

            $coordinatesAsString = $this->coordinatesAsString($positionX, $positionY);

            if (!array_key_exists($coordinatesAsString, $pointsPositions)) {
                $pointsPositions[$coordinatesAsString] = 1;
            } else {
                $pointsPositions[$coordinatesAsString]++;
            }
        }

        return [$points, $pointsPositions];
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return string
     */
    private function coordinatesAsString($x, $y)
    {
        return sprintf("%s,%s", $x, $y);
    }

    /**
     * @param Point[] $points
     * @param int[] $pointsPositions Map<string, int>
     *
     * @return bool
     */
    public function arePointsAligned(array $points, array $pointsPositions)
    {
        foreach ($points as $point) {
            $x = $point->getPositionX();
            $y = $point->getPositionY();

            if (!array_key_exists($this->coordinatesAsString($x - 1, $y), $pointsPositions)
                && !array_key_exists($this->coordinatesAsString($x + 1, $y), $pointsPositions)
                && !array_key_exists($this->coordinatesAsString($x, $y - 1), $pointsPositions)
                && !array_key_exists($this->coordinatesAsString($x, $y + 1), $pointsPositions)
                && !array_key_exists($this->coordinatesAsString($x - 1, $y - 1), $pointsPositions)
                && !array_key_exists($this->coordinatesAsString($x - 1, $y + 1), $pointsPositions)
                && !array_key_exists($this->coordinatesAsString($x + 1, $y - 1), $pointsPositions)
                && !array_key_exists($this->coordinatesAsString($x + 1, $y + 1), $pointsPositions)
            ) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param Point[] $points
     * @param int[] $pointsPositions Map<string, int>
     *
     * @return void
     */
    public function updatePointsPositions(array &$points, array &$pointsPositions)
    {
        foreach ($points as $i => $point) {
            $oldX = $point->getPositionX();
            $oldY = $point->getPositionY();
            $newX = $oldX + $point->getVelocityX();
            $newY = $oldY + $point->getVelocityY();

            $point->setNewPosition($newX, $newY);

            $oldCoordinatesAsString = $this->coordinatesAsString($oldX, $oldY);
            if ($pointsPositions[$oldCoordinatesAsString] - 1 === 0) {
                unset($pointsPositions[$oldCoordinatesAsString]);
            } else {
                $pointsPositions[$oldCoordinatesAsString]--;
            }

            $newCoordinatesAsString = $this->coordinatesAsString($newX, $newY);
            if (!array_key_exists($newCoordinatesAsString, $pointsPositions)) {
                $pointsPositions[$newCoordinatesAsString] = 1;
            } else {
                $pointsPositions[$newCoordinatesAsString]++;
            }
        }
    }

    /**
     * @param Point[] $points
     * @param int[] $pointsPositions Map<string, int>
     */
    private function printPoints(array $points, array $pointsPositions)
    {
        $minX = $minY = $maxX = $maxY = null;
        foreach ($points as $point) {
            if ($minX === null || $point->getPositionX() < $minX) {
                $minX = $point->getPositionX();
            }
            if ($minY === null || $point->getPositionY() < $minY) {
                $minY = $point->getPositionY();
            }
            if ($maxX === null || $point->getPositionX() > $maxX) {
                $maxX = $point->getPositionX();
            }
            if ($maxY === null || $point->getPositionY() > $maxY) {
                $maxY = $point->getPositionY();
            }
        }

        for ($y = $minY; $y <= $maxY; $y++) {
            for ($x = $minX; $x <= $maxX; $x++) {
                if (array_key_exists($this->coordinatesAsString($x, $y), $pointsPositions)) {
                    print(' #');
                } else {
                    print('  ');
                }
            }

            print("\n");
        }
    }
}
