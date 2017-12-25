<?php
/**
http://adventofcode.com/2017/day/8

--- Part Two ---

To be safe, the CPU also needs to know the highest value held in any register during this process so that it can decide how much memory to allocate to these operations. For example, in the above instructions, the highest value ever held was 10 (in register c after the third instruction was evaluated).

Although it hasn't changed, you can still get your puzzle input.

Your puzzle answer was 7234.
 */

use AdventOfCode2017\Common\SolutionRunner;
use AdventOfCode2017\Day08\Day08Part1Solver;
use AdventOfCode2017\Day08\Day08Part2Solver;

require_once '../bootstrap.php';

$input = file_get_contents('inputs/08-input.txt');
$output = (new SolutionRunner(new Day08Part2Solver(new Day08Part1Solver())))->run($input);
print($output);