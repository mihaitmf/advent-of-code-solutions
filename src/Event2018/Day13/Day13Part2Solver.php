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
    private static $MAP_NEW_POSITION_DIRECTION = [
        Cart::DIRECTION_LEFT => [
            '-' => Cart::DIRECTION_LEFT,
            '/' => Cart::DIRECTION_DOWN,
            '\\' => Cart::DIRECTION_UP,
            '+' => [
                Cart::INTERSECTION_DECISION_LEFT => Cart::DIRECTION_DOWN,
                Cart::INTERSECTION_DECISION_STRAIGHT => Cart::DIRECTION_LEFT,
                Cart::INTERSECTION_DECISION_RIGHT => Cart::DIRECTION_UP,
            ],
        ],
        Cart::DIRECTION_RIGHT => [
            '-' => Cart::DIRECTION_RIGHT,
            '/' => Cart::DIRECTION_UP,
            '\\' => Cart::DIRECTION_DOWN,
            '+' => [
                Cart::INTERSECTION_DECISION_LEFT => Cart::DIRECTION_UP,
                Cart::INTERSECTION_DECISION_STRAIGHT => Cart::DIRECTION_RIGHT,
                Cart::INTERSECTION_DECISION_RIGHT => Cart::DIRECTION_DOWN,
            ],
        ],
        Cart::DIRECTION_UP => [
            '|' => Cart::DIRECTION_UP,
            '/' => Cart::DIRECTION_RIGHT,
            '\\' => Cart::DIRECTION_LEFT,
            '+' => [
                Cart::INTERSECTION_DECISION_LEFT => Cart::DIRECTION_LEFT,
                Cart::INTERSECTION_DECISION_STRAIGHT => Cart::DIRECTION_UP,
                Cart::INTERSECTION_DECISION_RIGHT => Cart::DIRECTION_RIGHT,
            ],
        ],
        Cart::DIRECTION_DOWN => [
            '|' => Cart::DIRECTION_DOWN,
            '/' => Cart::DIRECTION_LEFT,
            '\\' => Cart::DIRECTION_RIGHT,
            '+' => [
                Cart::INTERSECTION_DECISION_LEFT => Cart::DIRECTION_RIGHT,
                Cart::INTERSECTION_DECISION_STRAIGHT => Cart::DIRECTION_DOWN,
                Cart::INTERSECTION_DECISION_RIGHT => Cart::DIRECTION_LEFT,
            ],
        ],
    ];

    /**
     * @Inject
     * @var GameMapParser
     */
    private $gameMapParser;

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

        $ticks = 1;
        while (true) {
            // sort carts by position, top to bottom, left to right
            usort($carts, $this->cartPositionComparator());

            foreach ($carts as $cartIndex => $cart) {
                if (!array_key_exists($cartIndex, $carts)) {
                    continue;
                }

                list($newX, $newY) = $this->calculateNewPosition($cart);

                $newCoordinatesAsString = $this->coordinatesAsString($newX, $newY);
                if ($this->isCollisionDetected($newCoordinatesAsString, $cartsPositions)) {
                    unset(
                        $cartsPositions[$this->coordinatesAsString($cart->getX(), $cart->getY())],
                        $cartsPositions[$newCoordinatesAsString],
                        $carts[$cartIndex],
                        $carts[$this->getCartIndexWithCoordinates($carts, $newX, $newY)]
                    );

                    continue;
                }

                unset($cartsPositions[$this->coordinatesAsString($cart->getX(), $cart->getY())]);
                $cartsPositions[$newCoordinatesAsString] = 1;

                $nextPath = $gameMap[$newY][$newX];
                $newDirection = $this->calculateNewDirection($nextPath, $cart);

                $cart->setNewPosition($newX, $newY, $newDirection);

                if ($nextPath === '+') {
                    $cart->incrementIntersectionDecision();
                }
            }

            if (count($carts) === 1) {
                $remainingCart = end($carts);

                return $this->coordinatesAsString($remainingCart->getX(), $remainingCart->getY());
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

    /**
     * @return \Closure
     */
    private function cartPositionComparator()
    {
        return function (Cart $a, Cart $b) {
            if ($a->getX() === $b->getX() && $a->getY() === $b->getY()) {
                return 0;
            }

            if ($a->getY() < $b->getY()) {
                return -1;
            }

            if ($a->getY() === $b->getY() && $a->getX() < $b->getX()) {
                return -1;
            }

            return 1;
        };
    }

    /**
     * @param Cart $cart
     *
     * @return int[]
     */
    private function calculateNewPosition(Cart $cart)
    {
        $x = $cart->getX();
        $y = $cart->getY();

        switch ($cart->getDirection()) {
            case Cart::DIRECTION_LEFT:
                return [$x - 1, $y];

            case Cart::DIRECTION_RIGHT:
                return [$x + 1, $y];

            case Cart::DIRECTION_UP:
                return [$x, $y - 1];

            case Cart::DIRECTION_DOWN:
                return [$x, $y + 1];

            default:
                throw new \RuntimeException("Invalid card direction found");
        }
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
     * @param string $newCoordinatesAsString
     * @param int[] $cartsPositions
     *
     * @return bool
     */
    private function isCollisionDetected($newCoordinatesAsString, array $cartsPositions)
    {
        return array_key_exists($newCoordinatesAsString, $cartsPositions);
    }

    /**
     * @param string $nextPath
     * @param Cart $cart
     *
     * @return int
     */
    private function calculateNewDirection($nextPath, Cart $cart)
    {
        $currentDirection = $cart->getDirection();

        switch ($nextPath) {
            case '-':
            case '|':
            case '/':
            case '\\':
                return self::$MAP_NEW_POSITION_DIRECTION[$currentDirection][$nextPath];

            case '+':
                return self::$MAP_NEW_POSITION_DIRECTION[$currentDirection][$nextPath][$cart->getIntersectionDecision()];

            default:
                throw new \RuntimeException("Invalid path found on game map");
        }
    }
}
