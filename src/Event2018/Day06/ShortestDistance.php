<?php

namespace AdventOfCode\Event2018\Day06;

class ShortestDistance
{
    /** @var int */
    private $value;

    /** @var int */
    private $ownerCoordinateId;

    /**
     * @param int $value
     * @param int $ownerCoordinateId
     */
    public function __construct($value, $ownerCoordinateId)
    {
        $this->value = $value;
        $this->ownerCoordinateId = $ownerCoordinateId;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getOwnerCoordinateId()
    {
        return $this->ownerCoordinateId;
    }
}
