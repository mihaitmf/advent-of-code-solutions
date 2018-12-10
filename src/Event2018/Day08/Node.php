<?php

namespace AdventOfCode\Event2018\Day08;

class Node
{
    /** @var int */
    private $childrenCount;

    /** @var int */
    private $metadataCount;

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
     * @return int
     */
    public function getMetadataCount()
    {
        return $this->metadataCount;
    }
}
