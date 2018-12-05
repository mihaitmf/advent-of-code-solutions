<?php

namespace AdventOfCode\Event2018\Day05;

use AdventOfCode\Common\Solver;

/**
 * http://adventofcode.com/2018/day/5
 *
--- Part Two ---
Time to improve the polymer.

One of the unit types is causing problems; it's preventing the polymer from collapsing as much as it should. Your goal is to figure out which unit type is causing the most problems, remove all instances of it (regardless of polarity), fully react the remaining polymer, and measure its length.

For example, again using the polymer dabAcCaCBAcCcaDA from above:

Removing all A/a units produces dbcCCBcCcD. Fully reacting this polymer produces dbCBcD, which has length 6.
Removing all B/b units produces daAcCaCAcCcaDA. Fully reacting this polymer produces daCAcaDA, which has length 8.
Removing all C/c units produces dabAaBAaDA. Fully reacting this polymer produces daDA, which has length 4.
Removing all D/d units produces abAcCaCBAcCcaA. Fully reacting this polymer produces abCBAc, which has length 6.
In this example, removing all C/c units was best, producing the answer 4.

What is the length of the shortest polymer you can produce by removing all units of exactly one type and fully reacting the result?

Your puzzle answer was 5446.
 */
class Day05Part2Solver implements Solver
{
    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $inputLength = strlen($input);

        $differentElements = [];
        for ($i = 0; $i < $inputLength; $i++) {
            $differentElements[strtolower($input[$i])] = 1;
        }

        $minStackCount = null;
        foreach ($differentElements as $ignoredElement => $unimportantValue) {
            $stack = new \SplStack();

            for ($i = 0; $i < $inputLength; $i++) {
                $currentElement = $input[$i];
                $currentELementLowerCase = strtolower($currentElement);

                if ($currentELementLowerCase === $ignoredElement) {
                    continue;
                }

                if ($stack->count() !== 0
                    && $stack->top() !== $currentElement
                    && strtolower($stack->top()) === $currentELementLowerCase
                ) {
                    $stack->pop();

                } else {
                    $stack->push($currentElement);
                }
            }

            $currentStackCount = $stack->count();
            if ($minStackCount === null) {
                $minStackCount = $currentStackCount;
            } else {
                $minStackCount = min($minStackCount, $currentStackCount);
            }
        }

        return (string)$minStackCount;
    }
}
