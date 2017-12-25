<?php
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

use AdventOfCode2017\Common\SolutionRunner;
use AdventOfCode2017\Day04\Day04Part2Solver;

require_once '../bootstrap.php';

$input = file_get_contents('inputs/04-input.txt');
$output = (new SolutionRunner(new Day04Part2Solver()))->run($input);
print($output);