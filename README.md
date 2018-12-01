# Advent of Code 2017
[![Build Status](https://travis-ci.org/mihaitmf/advent-of-code-2017.svg?branch=master)](https://travis-ci.org/mihaitmf/advent-of-code-2017)

:santa: :christmas_tree: Christmas is approaching so this is a great time to solve some really nice programming puzzles.

This repository contains my solutions for the problems posted each day on the Advent of Code website:
- 2017 edition: http://adventofcode.com/2017
- 2018 edition: http://adventofcode.com/2018

### Requirements
- [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.5-8892BF.svg?style=flat-square)](https://php.net/)
- composer

### How to run the solutions
- Run `composer install` from the root of the project.
- Execute the `run.php` file to solve the problems for each day.
The solution runner requires two integer arguments:
    - the **day** of the problem (from 1 to 25),
    - the **part** of the problem (1 or 2).

Example to run solution for day 9, part 2: `php run.php 9 2`

### How to add a new solution
In order to implement a new solution, one needs to create or modify in total 4 files:
- First create a new directory for the "day" of the problem named "DayXX" under the `src` directory, where XX is the 2-digits number of the day. Example: `Day01`. Then, create a new implementation of the `Solver` interface. This will contain the code of the solution for the problem from the given *day* and *part*. Example: class `Day01Part1Solver`.
- In the same directory create a new implementation of the `ExamplesProvider` interface which will give the pairs of sample input - output data used to test the solutions against. Usually the examples are provided in the description of the problem, so you can just copy those, or create your own ones. Example: class `Day01Part1Examples`.
- Create a new file in the `inputs` directory and paste into it the input data for the problem. Usually the input is the same for both parts of the problem. Example input file name: `day01.txt`.
- Finally, wire all the new classes together by updating the `DaysSolversMapper` class to map the new implementations to the *day* and *part* arguments. 

Enjoy!
