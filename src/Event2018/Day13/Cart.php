<?php

namespace AdventOfCode\Event2018\Day13;

class Cart
{
    const DIRECTION_LEFT = 0;
    const DIRECTION_RIGHT = 1;
    const DIRECTION_UP = 2;
    const DIRECTION_DOWN = 3;

    const INTERSECTION_DECISION_LEFT = 0;
    const INTERSECTION_DECISION_STRAIGHT = 1;
    const INTERSECTION_DECISION_RIGHT = 2;

    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /** @var int */
    private $direction;

    /** @var int */
    private $intersectionDecision;

    /**
     * @param int $x
     * @param int $y
     * @param int $direction
     */
    public function __construct($x, $y, $direction)
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
        $this->intersectionDecision = self::INTERSECTION_DECISION_LEFT;
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $direction
     *
     * @return void
     */
    public function setNewPosition($x, $y, $direction)
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
    }

    /**
     * @return void
     */
    public function incrementIntersectionDecision()
    {
        $this->intersectionDecision = $this->calculateNextIntersectionDecision($this->intersectionDecision);
    }

    /**
     * @param int $lastIntersectionDecision
     *
     * @return int
     */
    private function calculateNextIntersectionDecision($lastIntersectionDecision)
    {
        switch ($lastIntersectionDecision) {
            case self::INTERSECTION_DECISION_LEFT:
                return self::INTERSECTION_DECISION_STRAIGHT;
            case self::INTERSECTION_DECISION_STRAIGHT:
                return self::INTERSECTION_DECISION_RIGHT;
            case self::INTERSECTION_DECISION_RIGHT:
                return self::INTERSECTION_DECISION_LEFT;
            default:
                throw new \RuntimeException("Invalid intersection decision");
        }
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @return int
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @return int
     */
    public function getIntersectionDecision()
    {
        return $this->intersectionDecision;
    }
}
