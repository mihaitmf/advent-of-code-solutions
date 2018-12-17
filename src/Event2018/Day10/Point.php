<?php

namespace AdventOfCode\Event2018\Day10;

class Point
{
    /** @var int */
    private $positionX;

    /** @var int */
    private $positionY;

    /** @var int */
    private $velocityX;

    /** @var int */
    private $velocityY;

    /**
     * @param int $positionX
     * @param int $positionY
     * @param int $velocityX
     * @param int $velocityY
     */
    public function __construct($positionX, $positionY, $velocityX, $velocityY)
    {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->velocityX = $velocityX;
        $this->velocityY = $velocityY;
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return void
     */
    public function setNewPosition($x, $y)
    {
        $this->positionX = $x;
        $this->positionY = $y;
    }

    /**
     * @return int
     */
    public function getPositionX()
    {
        return $this->positionX;
    }

    /**
     * @return int
     */
    public function getPositionY()
    {
        return $this->positionY;
    }

    /**
     * @return int
     */
    public function getVelocityX()
    {
        return $this->velocityX;
    }

    /**
     * @return int
     */
    public function getVelocityY()
    {
        return $this->velocityY;
    }
}
