<?php

namespace AdventOfCode\Event2017\Day08;

use AdventOfCode\Common\Solver;

/**
http://adventofcode.com/2017/day/8

--- Part Two ---

To be safe, the CPU also needs to know the highest value held in any register during this process so that it can decide how much memory to allocate to these operations. For example, in the above instructions, the highest value ever held was 10 (in register c after the third instruction was evaluated).

Although it hasn't changed, you can still get your puzzle input.

Your puzzle answer was 7234.
 */
class Day08Part2Solver implements Solver
{
    /** @var Day08Part1Solver */
    private $part1Solver;

    public function __construct(Day08Part1Solver $part1Solver)
    {
        $this->part1Solver = $part1Solver;
    }

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $instructions = explode("\n", $input);

        $registers = [];
        $maxRegisterValue = 0;

        foreach ($instructions as $instruction) {
            $parts = explode(' if ', $instruction);
            $registerParts = explode(' ', $parts[0]);
            $conditionParts = explode(' ', $parts[1]);

            if (!$this->part1Solver->isConditionFulfilled($conditionParts, $registers)) {
                continue;
            }

            $registers = $this->part1Solver->applyOperationOnRegister($registerParts, $registers);

            $registerToUpdate = $registerParts[0];
            if ($registers[$registerToUpdate] > $maxRegisterValue) {
                $maxRegisterValue = $registers[$registerToUpdate];
            }
        }

        return (string)$maxRegisterValue;
    }
}
