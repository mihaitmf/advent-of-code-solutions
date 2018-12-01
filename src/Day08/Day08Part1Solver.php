<?php

namespace AdventOfCode2017\Day08;

use AdventOfCode2017\Common\Solver;
use RuntimeException;

/**
http://adventofcode.com/2017/day/8

--- Day 8: I Heard You Like Registers ---

You receive a signal directly from the CPU. Because of your recent assistance with jump instructions, it would like you to compute the result of a series of unusual register instructions.

Each instruction consists of several parts: the register to modify, whether to increase or decrease that register's value, the amount by which to increase or decrease it, and a condition. If the condition fails, skip the instruction without modifying the register. The registers all start at 0. The instructions look like this:

b inc 5 if a > 1
a inc 1 if b < 5
c dec -10 if a >= 1
c inc -20 if c == 10
These instructions would be processed as follows:

Because a starts at 0, it is not greater than 1, and so b is not modified.
a is increased by 1 (to 1) because b is less than 5 (it is 0).
c is decreased by -10 (to 10) because a is now greater than or equal to 1 (it is 1).
c is increased by -20 (to -10) because c is equal to 10.
After this process, the largest value in any register is 1.

You might also encounter <= (less than or equal to) or != (not equal to). However, the CPU doesn't have the bandwidth to tell you what all the registers are named, and leaves that to you to determine.

What is the largest value in any register after completing the instructions in your puzzle input?

To begin, get your puzzle input.

Your puzzle answer was 6828.
 */
class Day08Part1Solver implements Solver
{
    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $instructions = explode("\n", $input);

        $registers = [];
        foreach ($instructions as $instruction) {
            $parts = explode(' if ', $instruction);
            $registerParts = explode(' ', $parts[0]);
            $conditionParts = explode(' ', $parts[1]);

            if (!$this->isConditionFulfilled($conditionParts, $registers)) {
                continue;
            }

            $registers = $this->applyOperationOnRegister($registerParts, $registers);
        }

        return (string)$this->findMaxValue($registers);
    }

    /**
     * @param string[] $conditionParts
     * @param array $registers Map<string, int>
     *
     * @return bool
     */
    public function isConditionFulfilled(array $conditionParts, array $registers)
    {
        $conditionRegister = $conditionParts[0];
        $conditionOperator = $conditionParts[1];
        $conditionValue = (int)$conditionParts[2];

        $registerValue = 0;
        if (array_key_exists($conditionRegister, $registers)) {
            $registerValue = (int)$registers[$conditionRegister];
        }

        switch ($conditionOperator) {
            case '<':
                return $registerValue < $conditionValue;
            case '<=':
                return $registerValue <= $conditionValue;
            case '>':
                return $registerValue > $conditionValue;
            case '>=':
                return $registerValue >= $conditionValue;
            case '==':
                return $registerValue === $conditionValue;
            case '!=':
                return $registerValue !== $conditionValue;
            default:
                throw new RuntimeException("Unexpected operator found: {$conditionOperator}");
        }
    }

    /**
     * @param string[] $registerParts
     * @param array $registers Map<string, int>
     *
     * @return array Map<string, int>
     */
    public function applyOperationOnRegister(array $registerParts, array $registers)
    {
        $registerToUpdate = $registerParts[0];
        $registerOperation = $registerParts[1];
        $registerOperationValue = (int)$registerParts[2];

        if (!array_key_exists($registerToUpdate, $registers)) {
            $registers[$registerToUpdate] = 0;
        }

        switch ($registerOperation) {
            case 'inc':
                $registers[$registerToUpdate] += $registerOperationValue;
                break;
            case 'dec':
                $registers[$registerToUpdate] -= $registerOperationValue;
                break;
            default:
                throw new RuntimeException("Unexpected register operation found: {$registerOperation}");
        }

        return $registers;
    }

    /**
     * @param array $registers Map<string, int>
     *
     * @return int
     */
    private function findMaxValue(array $registers)
    {
        $maxRegisterValue = null;
        foreach ($registers as $registerValue) {
            $registerValue = (int)$registerValue;
            if ($maxRegisterValue === null) {
                $maxRegisterValue = $registerValue;

            } elseif ($registerValue > $maxRegisterValue) {
                $maxRegisterValue = $registerValue;
            }
        }
        return $maxRegisterValue;
    }
}
