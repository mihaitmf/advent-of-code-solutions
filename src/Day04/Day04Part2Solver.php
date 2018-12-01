<?php
namespace AdventOfCode2017\Day04;

use AdventOfCode2017\Common\Solver;

/**
http://adventofcode.com/2017/day/4

--- Part Two ---

For added security, yet another system policy has been put in place. Now, a valid passphrase must contain no two words that are anagrams of each other - that is, a passphrase is invalid if any word's letters can be rearranged to form any other word in the passphrase.

For example:

abcde fghij is a valid passphrase.
abcde xyz ecdab is not valid - the letters from the third word can be rearranged to form the first word.
a ab abc abd abf abj is a valid passphrase, because all letters need to be used when forming another word.
iiii oiii ooii oooi oooo is valid.
oiii ioii iioi iiio is not valid - any of these words can be rearranged to form any other word.
Under this new system policy, how many passphrases are valid?

Although it hasn't changed, you can still get your puzzle input.

Your puzzle answer was 186.
 */
class Day04Part2Solver implements Solver
{
    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $passphrases = explode("\n", $input);

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

        return (string)$validCount;
    }
}
