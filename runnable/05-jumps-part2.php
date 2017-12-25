<?php
/**
http://adventofcode.com/2017/day/5

--- Part Two ---

Now, the jumps are even stranger: after each jump, if the offset was three or more, instead decrease it by 1. Otherwise, increase it by 1 as before.

Using this rule with the above example, the process now takes 10 steps, and the offset values after finding the exit are left as 2 3 2 3 -1.

How many steps does it now take to reach the exit?

Although it hasn't changed, you can still get your puzzle input.

Your puzzle answer was 30513679.
 */

use AdventOfCode2017\Common\SolutionRunner;
use AdventOfCode2017\Day05\Day05Part2Solver;

require_once '../bootstrap.php';

$input = file_get_contents('inputs/05-input.txt');
$output = (new SolutionRunner(new Day05Part2Solver()))->run($input);
print($output);