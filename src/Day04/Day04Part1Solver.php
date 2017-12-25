<?php
namespace AdventOfCode2017\Day04;

use AdventOfCode2017\Common\SolutionExample;
use AdventOfCode2017\Common\Solver;

class Day04Part1Solver implements Solver
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
                if (array_key_exists($word, $visited)) {
                    $validCount--;
                    break;

                } else {
                    $visited[$word] = 1;
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
                'aa bb cc dd ee
aa bb cc dd aa
aa bb cc dd aaa',
                '2'
            ),
        ];
    }
}