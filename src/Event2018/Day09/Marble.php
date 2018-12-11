<?php

namespace AdventOfCode\Event2018\Day09;

class Marble
{
    /** @var int */
    private $value;

    /** @var Marble */
    private $next;

    /** @var Marble */
    private $prev;

    /**
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return Marble
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param Marble $next
     *
     * @return Marble
     */
    public function setNext($next)
    {
        $this->next = $next;
        return $this;
    }

    /**
     * @return Marble
     */
    public function getPrev()
    {
        return $this->prev;
    }

    /**
     * @param Marble $prev
     *
     * @return Marble
     */
    public function setPrev($prev)
    {
        $this->prev = $prev;
        return $this;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}
