<?php
namespace AdventOfCode2017\Day04;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day04Part2Solver implements Solver
{
    /**
     * @param string $input
     * @return string
     */
    public function solve($input)
    {
        $passphrases = explode("\r\n", $input);

        $validCount = count($passphrases);

        foreach ($passphrases as $passphrase) {
            $words = explode(" ", $passphrase);

            $visited = [];
            foreach ($words as $word) {
                $charsArray = str_split($word);
                sort($charsArray);
                $sortedWord = implode('', $charsArray);

                if (array_key_exists($sortedWord, $visited)) {
                    $validCount--;
                    break;

                } else {
                    $visited[$sortedWord] = 1;
                }
            }
        }

        return $validCount;
    }

    /**
     * @return SolutionExample[]
     */
    public function getExamples()
    {
        return [
            SolutionExample::of(
                'abcde fghij
abcde xyz ecdab
a ab abc abd abf abj
iiii oiii ooii oooi oooo
oiii ioii iioi iiio',
                '3'
            ),
        ];
    }
}