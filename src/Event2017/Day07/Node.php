<?php

namespace AdventOfCode\Event2017\Day07;

class Node
{
    /** @var string */
    private $name;

    /** @var int */
    private $weight;

    /** @var string[] */
    private $childrenNames;

    /**
     * @param string $name
     * @param int $weight
     * @param string[] $childrenNames
     */
    public function __construct($name, $weight, array $childrenNames)
    {
        $this->name = $name;
        $this->weight = $weight;
        $this->childrenNames = $childrenNames;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return string[]
     */
    public function getChildrenNames()
    {
        return $this->childrenNames;
    }
}
