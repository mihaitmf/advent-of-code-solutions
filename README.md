# Advent of Code Solutions
[![Build Status](https://travis-ci.org/mihaitmf/advent-of-code-solutions.svg?branch=master)](https://travis-ci.org/mihaitmf/advent-of-code-solutions)

:santa: :christmas_tree: Christmas is approaching so this is a great time to solve some really nice programming puzzles.

This repository contains my solutions for the problems posted each day on the Advent of Code website:
- 2017 edition: http://adventofcode.com/2017
- 2018 edition: http://adventofcode.com/2018

The solutions are implemented in *php*.

## Requirements
- [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.5-8892BF.svg?style=flat-square)](https://php.net/)
- composer

## How to run the solutions
- Run `composer install` from the root of the project.
- Execute the `run.php` file to solve the problems for each day.
The solution runner requires three integer arguments:
    - the **year** of the event (2017 or 2018),
    - the **day** of the problem (from 1 to 25),
    - the **part** of the problem (1 or 2).
    
Example to run solution for the 2017 event, day 9, part 2: `php run.php 2017 9 2`

The default runner arguments can also be defined in the `config.ini` file.

## How to add a new solution
### The pretty way
In order to implement a new solution, one needs to create **3 files**.

- First create a new directory for the **day** of the problem named *DayXX* under the `/src/EventYYYY/` directory, where *XX* is the 2-digit number of the *day* and *YYYY* is the 4-digit *year* of the event. Example: `/src/Event2017/Day01/`. 
- Then, create a new implementation of the `Solver` interface which will contain the code of the solution. Each *part* of the problem from the given *day* has its own implementation. Example: class `Day01Part1Solver`.
- In the same directory create a new implementation of the `ExamplesProvider` interface which will give the pairs of sample input-output data used to test the solutions against. Usually the examples are provided in the description of the problem, so you can just copy those, or create your own ones. Example: class `Day01Part1Examples`.
- Create a new file in the `/inputs/YYYY/` directory, where *YYYY* is the 4-digit *year* of the event, and paste into it the input data for the problem. The input is the same for both parts of the problem for a given day. Example input file name: `/inputs/2017/day01.txt`.

All the wiring of the implementation classes and mapping of the *year*, *day* and *part* arguments is done in the `DaysSolversMapper` class. If you don't want to follow the default structure and naming of the classes, just add an entry on the map in this class with your custom preferences.

### The fast way
For the situations when we didn't have time to prepare the new classes for the next day's problem, there is a "Fast Solution" runner for "quick and dirty" coding :).

The recommendation is to still add the solution "the pretty way" after the fast solution has been finished and submitted.

The runner is located in the `fast-solution` directory. There is also an empty `input.txt` file. Just paste the problem input into it and the runner will read it. 

The Fast Solution runner comes prefilled with some common input parsing functions to give you a head start.

## Enjoy!
