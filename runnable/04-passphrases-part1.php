<?php
/**
http://adventofcode.com/2017/day/4

--- Day 4: High-Entropy Passphrases ---

A new system policy has been put in place that requires all accounts to use a passphrase instead of simply a password. A passphrase consists of a series of words (lowercase letters) separated by spaces.

To ensure security, a valid passphrase must contain no duplicate words.

For example:

aa bb cc dd ee is valid.
aa bb cc dd aa is not valid - the word aa appears more than once.
aa bb cc dd aaa is valid - aa and aaa count as different words.
The system's full passphrase list is available as your puzzle input. How many passphrases are valid?

To begin, get your puzzle input.

Your puzzle answer was 455.
 */

use AdventOfCode2017\Common\SolutionRunner;
use AdventOfCode2017\Day04\Day04Part1Solver;

require_once '../bootstrap.php';

$input = file_get_contents('inputs/04-input.txt');
$output = (new SolutionRunner(new Day04Part1Solver()))->run($input);
print($output);