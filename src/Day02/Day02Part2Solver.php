<?php
namespace AdventOfCode2017\Day02;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day02Part2Solver implements Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        $rows = explode("\r\n", $input);

        var_dump($rows);

        $sum = 0;
        foreach ($rows as $row) {
            $items = explode("\t", $row);

            var_dump($row);

            $rowLength = count($items);

            for ($i = 0; $i < $rowLength - 1; $i++) {
                for ($j = $i + 1; $j < $rowLength; $j++) {
                    if ($items[$i] % $items[$j] === 0) {
                        $sum += $items[$i] / $items[$j];
                    } elseif ($items[$j] % $items[$i] === 0) {
                        $sum += $items[$j] / $items[$i];
                    }

                    var_dump($sum);
                }
            }
        }

        return (string)$sum;
    }

    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                '5	9	2	8
                9	4	7	3
                3	8	6	5',
                '9'
            ),
        ];
    }
}