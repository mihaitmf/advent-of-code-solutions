<?php

namespace AdventOfCode\Event2018\Day02;

use AdventOfCode\Common\Solver;
use RuntimeException;

/**
 * http://adventofcode.com/2018/day/2
 *
--- Part Two ---
Confident that your list of box IDs is complete, you're ready to find the boxes full of prototype fabric.

The boxes will have IDs which differ by exactly one character at the same position in both strings. For example, given the following box IDs:

abcde
fghij
klmno
pqrst
fguij
axcye
wvxyz
The IDs abcde and axcye are close, but they differ by two characters (the second and fourth). However, the IDs fghij and fguij differ by exactly one character, the third (h and u). Those must be the correct boxes.

What letters are common between the two correct box IDs? (In the example above, this is found by removing the differing character from either ID, producing fgij.)

Your puzzle answer was pazvmqbftrbeosiecxlghkwud.
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
        $items = explode("\n", $input);
        $itemsCount = count($items);

        for ($i = 0; $i < $itemsCount - 1; $i++) {
            $itemLength = strlen($items[$i]);
            for ($j = $i + 1; $j < $itemsCount; $j++) {
                if ($itemLength !== strlen($items[$j])) {
                    throw new RuntimeException("Input should contain strings of same length");
                }

                $countDiffChar = 0;
                $commonChars = "";
                for ($k = 0; $k < $itemLength; $k++) {
                    if ($items[$i][$k] !== $items[$j][$k]) {
                        $countDiffChar++;
                    } else {
                        $commonChars .= $items[$i][$k];
                    }

                    if ($countDiffChar > 1) {
                        break;
                    }
                }

                if ($countDiffChar === 1) {
                    return $commonChars;
                }
            }
        }

        throw new RuntimeException("No solution found");
    }
}
