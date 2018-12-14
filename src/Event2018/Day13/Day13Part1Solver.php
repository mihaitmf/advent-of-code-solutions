<?php

namespace AdventOfCode\Event2018\Day13;

use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;

/**
 * http://adventofcode.com/2018/day/13
 *
--- Day 13: Mine Cart Madness ---
A crop of this size requires significant logistics to transport produce, soil, fertilizer, and so on. The Elves are very busy pushing things around in carts on some kind of rudimentary system of tracks they've come up with.

Seeing as how cart-and-track systems don't appear in recorded history for another 1000 years, the Elves seem to be making this up as they go along. They haven't even figured out how to avoid collisions yet.

You map out the tracks (your puzzle input) and see where you can help.

Tracks consist of straight paths (| and -), curves (/ and \), and intersections (+). Curves connect exactly two perpendicular pieces of track; for example, this is a closed loop:

/----\
|    |
|    |
\----/
Intersections occur when two perpendicular paths cross. At an intersection, a cart is capable of turning left, turning right, or continuing straight. Here are two loops connected by two intersections:

/-----\
|     |
|  /--+--\
|  |  |  |
\--+--/  |
|     |
\-----/
Several carts are also on the tracks. Carts always face either up (^), down (v), left (<), or right (>). (On your initial map, the track under each cart is a straight path matching the direction the cart is facing.)

Each time a cart has the option to turn (by arriving at any intersection), it turns left the first time, goes straight the second time, turns right the third time, and then repeats those directions starting again with left the fourth time, straight the fifth time, and so on. This process is independent of the particular intersection at which the cart has arrived - that is, the cart has no per-intersection memory.

Carts all move at the same speed; they take turns moving a single step at a time. They do this based on their current location: carts on the top row move first (acting from left to right), then carts on the second row move (again from left to right), then carts on the third row, and so on. Once each cart has moved one step, the process repeats; each of these loops is called a tick.

For example, suppose there are two carts on a straight track:

|  |  |  |  |
v  |  |  |  |
|  v  v  |  |
|  |  |  v  X
|  |  ^  ^  |
^  ^  |  |  |
|  |  |  |  |
First, the top cart moves. It is facing down (v), so it moves down one square. Second, the bottom cart moves. It is facing up (^), so it moves up one square. Because all carts have moved, the first tick ends. Then, the process repeats, starting with the first cart. The first cart moves down, then the second cart moves up - right into the first cart, colliding with it! (The location of the crash is marked with an X.) This ends the second and last tick.

Here is a longer example:

/->-\
|   |  /----\
| /-+--+-\  |
| | |  | v  |
\-+-/  \-+--/
\------/

/-->\
|   |  /----\
| /-+--+-\  |
| | |  | |  |
\-+-/  \->--/
\------/

/---v
|   |  /----\
| /-+--+-\  |
| | |  | |  |
\-+-/  \-+>-/
\------/

/---\
|   v  /----\
| /-+--+-\  |
| | |  | |  |
\-+-/  \-+->/
\------/

/---\
|   |  /----\
| /->--+-\  |
| | |  | |  |
\-+-/  \-+--^
\------/

/---\
|   |  /----\
| /-+>-+-\  |
| | |  | |  ^
\-+-/  \-+--/
\------/

/---\
|   |  /----\
| /-+->+-\  ^
| | |  | |  |
\-+-/  \-+--/
\------/

/---\
|   |  /----<
| /-+-->-\  |
| | |  | |  |
\-+-/  \-+--/
\------/

/---\
|   |  /---<\
| /-+--+>\  |
| | |  | |  |
\-+-/  \-+--/
\------/

/---\
|   |  /--<-\
| /-+--+-v  |
| | |  | |  |
\-+-/  \-+--/
\------/

/---\
|   |  /-<--\
| /-+--+-\  |
| | |  | v  |
\-+-/  \-+--/
\------/

/---\
|   |  /<---\
| /-+--+-\  |
| | |  | |  |
\-+-/  \-<--/
\------/

/---\
|   |  v----\
| /-+--+-\  |
| | |  | |  |
\-+-/  \<+--/
\------/

/---\
|   |  /----\
| /-+--v-\  |
| | |  | |  |
\-+-/  ^-+--/
\------/

/---\
|   |  /----\
| /-+--+-\  |
| | |  X |  |
\-+-/  \-+--/
\------/
After following their respective paths for a while, the carts eventually crash. To help prevent crashes, you'd like to know the location of the first crash. Locations are given in X,Y coordinates, where the furthest left column is X=0 and the furthest top row is Y=0:

111
0123456789012
0/---\
1|   |  /----\
2| /-+--+-\  |
3| | |  X |  |
4\-+-/  \-+--/
5  \------/
In this example, the location of the first crash is 7,3.

Your puzzle answer was 124,90.
 */
class Day13Part1Solver implements Solver
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

        while (true) {
            // sort carts by position, top to bottom, left to right
            usort($carts, $this->cartPositionComparator());

            foreach ($carts as $cart) {
                list($newX, $newY) = $this->calculateNewPosition($cart);

                $newCoordinatesAsString = $this->coordinatesAsString($newX, $newY);
                if ($this->isCollisionDetected($newCoordinatesAsString, $cartsPositions)) {
                    return $newCoordinatesAsString;
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
