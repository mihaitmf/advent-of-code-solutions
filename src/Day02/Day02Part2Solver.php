<?php
namespace AdventOfCode2017\Day02;

use AdventOfCode2017\Common\Solver;

/**
http://adventofcode.com/2017/day/2

--- Part Two ---

"Great work; looks like we're on the right track after all. Here's a star for your effort." However, the program seems a little worried. Can programs be worried?

"Based on what we're seeing, it looks like all the User wanted is some information about the evenly divisible values in the spreadsheet. Unfortunately, none of us are equipped for that kind of calculation - most of us specialize in bitwise operations."

It sounds like the goal is to find the only two numbers in each row where one evenly divides the other - that is, where the result of the division operation is a whole number. They would like you to find those numbers on each line, divide them, and add up each line's result.

For example, given the following spreadsheet:

5 9 2 8
9 4 7 3
3 8 6 5
In the first row, the only two numbers that evenly divide are 8 and 2; the result of this division is 4.
In the second row, the two numbers are 9 and 3; the result is 3.
In the third row, the result is 2.
In this example, the sum of the results would be 4 + 3 + 2 = 9.

What is the sum of each row's result in your puzzle input?

Your puzzle answer was 280.
 */
class Day02Part2Solver implements Solver
{
    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $rows = explode("\n", $input);

        $sum = 0;
        foreach ($rows as $row) {
            $items = explode("\t", $row);

            $rowLength = count($items);

            for ($i = 0; $i < $rowLength - 1; $i++) {
                for ($j = $i + 1; $j < $rowLength; $j++) {
                    if ($items[$i] % $items[$j] === 0) {
                        $sum += $items[$i] / $items[$j];
                    } elseif ($items[$j] % $items[$i] === 0) {
                        $sum += $items[$j] / $items[$i];
                    }
                }
            }
        }

        return (string)$sum;
    }
}
