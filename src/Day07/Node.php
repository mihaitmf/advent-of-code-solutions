<?php
namespace AdventOfCode2017\Day07;

class Node
{
    /** @var string */
    private $name;

    /** @var int */
    private $weight;

    /** @var string[] */
    private $children;

    /**
     * @param string $name
     * @param int $weight
     * @param array $children
     */
    public function __construct($name, $weight, array $children)
    {
        $this->name = $name;
        $this->weight = $weight;
        $this->children = $children;
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
    public function getChildren()
    {
        return $this->children;
    }
}