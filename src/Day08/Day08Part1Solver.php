<?php
namespace AdventOfCode2017\Day08;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day08Part1Solver implements Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        $instructions = explode("\r\n", $input);

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

        $maxRegisterValue = null;
        foreach ($registers as $registerValue) {
            if ($maxRegisterValue === null) {
                $maxRegisterValue = $registerValue;

            } elseif ($registerValue > $maxRegisterValue) {
                $maxRegisterValue = $registerValue;
            }
        }

        return $maxRegisterValue;
    }

    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                'b inc 5 if a > 1
a inc 1 if b < 5
c dec -10 if a >= 1
c inc -20 if c == 10',
                '1'
            ),
        ];
    }

    /**
     * @param array $conditionParts
     * @param array $registers
     * @return bool
     * @throws \Exception
     */
    private function isConditionFulfilled(array $conditionParts, array $registers)
    {
        $conditionRegister = $conditionParts[0];
        $conditionOperator = $conditionParts[1];
        $conditionValue = (int)$conditionParts[2];

        $registerValue = 0;
        if (array_key_exists($conditionRegister, $registers)) {
            $registerValue = $registers[$conditionRegister];
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
                return $registerValue == $conditionValue;
            case '!=':
                return $registerValue != $conditionValue;
            default:
                throw new \Exception("Unexpected operator found: {$conditionOperator}");
        }
    }

    /**
     * @param array $registerParts
     * @param array $registers
     * @return array
     * @throws \Exception
     */
    private function applyOperationOnRegister(array $registerParts, array $registers)
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
                throw new \Exception("Unexpected register operation found: {$registerOperation}");
        }

        return $registers;
    }
}