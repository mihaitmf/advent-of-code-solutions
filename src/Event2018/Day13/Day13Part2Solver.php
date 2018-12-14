<?php

namespace AdventOfCode\Event2018\Day13;

use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;

/**
 * http://adventofcode.com/2018/day/13
 *
--- Part Two ---
There isn't much you can do to prevent crashes in this ridiculous system. However, by predicting the crashes, the Elves know where to be in advance and instantly remove the two crashing carts the moment any crash occurs.

They can proceed like this for a while, but eventually, they're going to run out of carts. It could be useful to figure out where the last cart that hasn't crashed will end up.

For example:

/>-<\
|   |
| /<+-\
| | | v
\>+</ |
|   ^
\<->/

/---\
|   |
| v-+-\
| | | |
\-+-/ |
|   |
^---^

/---\
|   |
| /-+-\
| v | |
\-+-/ |
^   ^
\---/

/---\
|   |
| /-+-\
| | | |
\-+-/ ^
|   |
\---/
After four very expensive crashes, a tick ends with only one cart remaining; its final location is 6,4.

What is the location of the last cart at the end of the first tick where it is the only cart left?

Your puzzle answer was 145,88.
 */
class Day13Part2Solver implements Solver
{
    /**
     * @Inject
     * @var GameMapParser
     */
    private $gameMapParser;

    /**
     * @Inject
     * @var Day13Part1Solver
     */
    private $part1Solver;

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        /**
         * @var string[][] $gameMap Matrix holding all game items as chars for each coordinate. Example: map[y][x] = '-'
         * @var Cart[] $carts
         * @var int[] $cartsPositions Map<string, int> = <cart-coordinates, 1>
         */
        list($gameMap, $carts, $cartsPositions) = $this->gameMapParser->parseGameMap($input);

        while (true) {
            // sort carts by position, top to bottom, left to right
            usort($carts, $this->part1Solver->cartPositionComparator());

            foreach ($carts as $cartIndex => $cart) {
                if (!array_key_exists($cartIndex, $carts)) {
                    continue;
                }

                list($newX, $newY) = $this->part1Solver->calculateNewPosition($cart);

                $newCoordinatesAsString = $this->part1Solver->coordinatesAsString($newX, $newY);
                $currentCoordinatesAsString = $this->part1Solver->coordinatesAsString($cart->getX(), $cart->getY());

                if ($this->part1Solver->isCollisionDetected($newCoordinatesAsString, $cartsPositions)) {
                    unset(
                        $cartsPositions[$currentCoordinatesAsString],
                        $cartsPositions[$newCoordinatesAsString],
                        $carts[$cartIndex],
                        $carts[$this->getCartIndexWithCoordinates($carts, $newX, $newY)]
                    );

                    continue;
                }

                // set new cart position
                unset($cartsPositions[$currentCoordinatesAsString]);
                $cartsPositions[$newCoordinatesAsString] = 1;

                $this->part1Solver->updateCartToNewPosition($cart, $gameMap, $newX, $newY);
            }

            if (count($carts) === 1) {
                $remainingCart = reset($carts);

                return $this->part1Solver->coordinatesAsString($remainingCart->getX(), $remainingCart->getY());
            }
        }
    }

    /**
     * @param Cart[] $carts
     * @param int $x
     * @param int $y
     *
     * @return int
     */
    private function getCartIndexWithCoordinates(array $carts, $x, $y)
    {
        foreach ($carts as $i => $cart) {
            if ($cart->getX() === $x && $cart->getY() === $y) {
                return $i;
            }
        }
    }
}
