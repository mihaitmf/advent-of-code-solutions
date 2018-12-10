<?php

namespace AdventOfCode\Event2018\Day08;

class Node
{
    /** @var int */
    private $childrenCount;

    /** @var int */
    private $metadataCount;

    /** @var array Map<int, int> = <childIndex, childValue> */
    private $childrenValues = [];

    /**
     * @param int $childrenCount
     * @param int $metadataCount
     */
    public function __construct($childrenCount, $metadataCount)
    {
        $this->childrenCount = $childrenCount;
        $this->metadataCount = $metadataCount;
    }

    /**
     * @return int
     */
    public function getChildrenCount()
    {
        return $this->childrenCount;
    }

    /**
     * @return void
     */
    public function decrementChildrenCount()
    {
        $this->childrenCount--;
    }

    /**
     * @return int
     */
    public function getMetadataCount()
    {
        return $this->metadataCount;
    }

    /**
     * @param int $nodeValue
     */
    public function addChildValue($nodeValue)
    {
        $this->childrenValues[] = $nodeValue;
    }

    /**
     * @return array Map<int, int> = <childIndex, childValue>
     */
    public function getChildrenValues()
    {
        return $this->childrenValues;
    }
}
