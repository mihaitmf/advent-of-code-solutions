<?php
namespace AdventOfCode2017\Common;

interface Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input);

    /**
     * @return SolutionExample[]
     */
    public function getExamples();
}