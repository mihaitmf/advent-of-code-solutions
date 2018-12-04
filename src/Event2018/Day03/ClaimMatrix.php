<?php

namespace AdventOfCode\Event2018\Day03;

class ClaimMatrix
{
    /** @var int */
    private $id;

    /** @var int */
    private $left;

    /** @var int */
    private $right;

    /** @var int */
    private $top;

    /** @var int */
    private $bottom;

    /**
     * @param int $id
     * @param int $left
     * @param int $right
     * @param int $top
     * @param int $bottom
     */
    public function __construct($id, $left, $right, $top, $bottom)
    {
        $this->id = $id;
        $this->left = $left;
        $this->right = $right;
        $this->top = $top;
        $this->bottom = $bottom;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @return int
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @return int
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * @return int
     */
    public function getBottom()
    {
        return $this->bottom;
    }
}
