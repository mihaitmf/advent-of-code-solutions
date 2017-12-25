<?php
namespace AdventOfCode2017\Day08;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

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
     * @return string
     */
    public function solve($input)
    {
        $instructions = explode("\r\n", $input);

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
                '10'
            ),
        ];
    }
}