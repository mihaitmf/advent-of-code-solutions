<?php

namespace AdventOfCode\Event2018\Day06;

class Point
{
    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /**
     * @param int $x
     * @param int $y
     */
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getSum()
    {
        return $this->x + $this->y;
    }
}
