<?php
/**
http://adventofcode.com/2017/day/1

 --- Part Two ---

You notice a progress bar that jumps to 50% completion. Apparently, the door isn't yet satisfied, but it did emit a star as encouragement. The instructions change:

Now, instead of considering the next digit, it wants you to consider the digit halfway around the circular list. That is, if your list contains 10 items, only include a digit in your sum if the digit 10/2 = 5 steps forward matches it. Fortunately, your list has an even number of elements.

For example:

1212 produces 6: the list contains 4 items, and all four digits match the digit 2 items ahead.
1221 produces 0, because every comparison is between a 1 and a 2.
123425 produces 4, because both 2s match each other, but no other digit has a match.
123123 produces 12.
12131415 produces 4.
What is the solution to your new captcha?

Your puzzle answer was 1244.
 */

use AdventOfCode2017\Common\SolutionRunner;
use AdventOfCode2017\Day01\Day01Part2Solver;

require_once '../bootstrap.php';

$input = file_get_contents('inputs/01-input.txt');
$output = (new SolutionRunner(new Day01Part2Solver()))->run($input);
print($output);
