<?php
namespace AdventOfCode2017\Day06;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day06Part1Solver implements Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        $states = [$input];
        $blocks = array_map('intval', explode("\t", $input));

        while (true) {
            $blocks = $this->redistribute($blocks);

            $newState = implode("\t", $blocks);
            foreach ($states as $state) {
                if ($state === $newState) {
                    return count($states);
                }
            }
            $states[] = $newState;
        }
    }

    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                '0	2	7	0',
                '5'
            ),
            SolutionExample::of(
                '3	2	0	3	2',
                /**
                 * 0 3 1 4 2
                 * 1 4 2 0 3
                 * 2 0 3 1 4
                 * 3 1 4 2 0
                 * 4 2 0 3 1
                 * 0 3 1 4 2
                 */
                '6'
            ),
        ];
    }

    /**
     * @param int[] $blocks
     * @return int
     */
    public function redistribute(array $blocks)
    {
        $maxIndex = $this->findMax($blocks);
        $maxValue = $blocks[$maxIndex];
        $blocks[$maxIndex] = 0;

        $length = count($blocks);

        for ($i = 0; $i < $length; $i++) {
            $blocks[$i] += (int)($maxValue / $length);

            $lastBlockToIncrement = ($maxValue % $length) + $maxIndex;
            if (($i > $maxIndex && $i <= $lastBlockToIncrement)
                || ($i < $maxIndex && $i + $length <= $lastBlockToIncrement)
            ) {
                $blocks[$i]++;
            }
        }

        return $blocks;
    }

    /**
     * @param int[] $blocks
     * @return int
     */
    private function findMax(array $blocks)
    {
        $maxIndex = 0;
        $maxValue = $blocks[$maxIndex];
        for ($i = 1; $i < count($blocks); $i++) {
            if ($blocks[$i] > $maxValue) {
                $maxIndex = $i;
                $maxValue = $blocks[$i];
            }
        }
        return $maxIndex;
    }
}