<?php

namespace AdventOfCode\Event2018\Day13;

class GameMapParser
{
    /** @var string[][] $gameMap Matrix holding all game items as chars for each coordinate. Example: map[y][x] = '-' */
    private $gameMap = [];

    /**
     * @param string $input
     *
     * @return array
     */
    public function parseGameMap($input)
    {
        /** @var Cart[] $carts */
        $carts = [];

        /** @var int[] $cartsPositions Map<string, int> = <cart-coordinates, 1>*/
        $cartsPositions = [];

        $rows = explode("\n", $input);
        $rowsCount = count($rows);

        for ($y = 0; $y < $rowsCount; $y++) {
            $rowSplit = str_split($rows[$y]);
            $columnsCount = count($rowSplit);

            for ($x = 0; $x < $columnsCount; $x++) {
                $gameMapItem = $rowSplit[$x];
                $cartDirection = null;

                $this->gameMap[$y][$x] = $gameMapItem;

                switch ($gameMapItem) {
                    case '<':
                        $cartDirection = Cart::DIRECTION_LEFT;
                        break;

                    case '>':
                        $cartDirection = Cart::DIRECTION_RIGHT;
                        break;

                    case '^':
                        $cartDirection = Cart::DIRECTION_UP;
                        break;

                    case 'v':
                        $cartDirection = Cart::DIRECTION_DOWN;
                        break;
                }

                if ($cartDirection !== null) {
                    $carts[] = new Cart($x, $y, $cartDirection);
                    $cartsPositions[$this->coordinatesAsString($x, $y)] = 1;
                }
            }
        }

        // update game map, replace cart chars with paths
        $this->replaceCartCharactersOnGameMap($carts);

        return [$this->gameMap, $carts, $cartsPositions];
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
     * @param Cart[] $carts
     *
     * @return void
     */
    private function replaceCartCharactersOnGameMap(array $carts)
    {
        foreach ($carts as $cart) {
            $x = $cart->getX();
            $y = $cart->getY();

            switch ($cart->getDirection()) {
                case Cart::DIRECTION_LEFT:
                    if ($this->isConnectedToTop($x, $y) && $this->isConnectedToBottom($x, $y)) {
                        $this->gameMap[$y][$x] = '+';

                    } elseif (!$this->isConnectedToRight($x, $y) && !$this->isConnectedToTop($x, $y)) {
                        $this->gameMap[$y][$x] = '\\';

                    } elseif (!$this->isConnectedToRight($x, $y) && !$this->isConnectedToBottom($x, $y)) {
                        $this->gameMap[$y][$x] = '/';

                    } else {
                        $this->gameMap[$y][$x] = '-';
                    }
                    break;

                case Cart::DIRECTION_RIGHT:
                    if ($this->isConnectedToTop($x, $y) && $this->isConnectedToBottom($x, $y)) {
                        $this->gameMap[$y][$x] = '+';

                    } elseif (!$this->isConnectedToLeft($x, $y) && !$this->isConnectedToBottom($x, $y)) {
                        $this->gameMap[$y][$x] = '\\';

                    } elseif (!$this->isConnectedToLeft($x, $y) && !$this->isConnectedToTop($x, $y)) {
                        $this->gameMap[$y][$x] = '/';

                    } else {
                        $this->gameMap[$y][$x] = '-';
                    }
                    break;

                case Cart::DIRECTION_UP:
                    if ($this->isConnectedToLeft($x, $y) && $this->isConnectedToRight($x, $y)) {
                        $this->gameMap[$y][$x] = '+';

                    } elseif (!$this->isConnectedToLeft($x, $y) && !$this->isConnectedToBottom($x, $y)) {
                        $this->gameMap[$y][$x] = '\\';

                    } elseif (!$this->isConnectedToRight($x, $y) && !$this->isConnectedToBottom($x, $y)) {
                        $this->gameMap[$y][$x] = '/';

                    } else {
                        $this->gameMap[$y][$x] = '|';
                    }
                    break;

                case Cart::DIRECTION_DOWN:
                    if ($this->isConnectedToLeft($x, $y) && $this->isConnectedToRight($x, $y)) {
                        $this->gameMap[$y][$x] = '+';

                    } elseif (!$this->isConnectedToRight($x, $y) && !$this->isConnectedToTop($x, $y)) {
                        $this->gameMap[$y][$x] = '\\';

                    } elseif (!$this->isConnectedToLeft($x, $y) && !$this->isConnectedToTop($x, $y)) {
                        $this->gameMap[$y][$x] = '/';

                    } else {
                        $this->gameMap[$y][$x] = '|';
                    }
                    break;
            }
        }
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return bool
     */
    private function isConnectedToTop($x, $y)
    {
        return $y > 0 && in_array($this->gameMap[$y - 1][$x], ['|', '+', '/', '\\'], true);
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return bool
     */
    private function isConnectedToBottom($x, $y)
    {
        return array_key_exists($y + 1, $this->gameMap) && in_array($this->gameMap[$y + 1][$x], ['|', '+', '/', '\\'], true);
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return bool
     */
    private function isConnectedToLeft($x, $y)
    {
        return $x > 0 && in_array($this->gameMap[$y][$x - 1], ['-', '+', '/', '\\'], true);
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return bool
     */
    private function isConnectedToRight($x, $y)
    {
        return array_key_exists($x + 1, $this->gameMap[$y]) && in_array($this->gameMap[$y][$x + 1], ['-', '+', '/', '\\'], true);
    }
}
