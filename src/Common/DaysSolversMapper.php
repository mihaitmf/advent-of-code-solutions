<?php

namespace AdventOfCode2017\Common;

use AdventOfCode2017\Day01\Day01Part1Examples;
use AdventOfCode2017\Day01\Day01Part1Solver;
use AdventOfCode2017\Day01\Day01Part2Examples;
use AdventOfCode2017\Day01\Day01Part2Solver;
use AdventOfCode2017\Day02\Day02Part1Examples;
use AdventOfCode2017\Day02\Day02Part1Solver;
use AdventOfCode2017\Day02\Day02Part2Examples;
use AdventOfCode2017\Day02\Day02Part2Solver;
use AdventOfCode2017\Day03\Day03Part1Examples;
use AdventOfCode2017\Day03\Day03Part1Solver;
use AdventOfCode2017\Day03\Day03Part2Examples;
use AdventOfCode2017\Day03\Day03Part2Solver;
use AdventOfCode2017\Day04\Day04Part1Examples;
use AdventOfCode2017\Day04\Day04Part1Solver;
use AdventOfCode2017\Day04\Day04Part2Examples;
use AdventOfCode2017\Day04\Day04Part2Solver;
use InvalidArgumentException;

class DaysSolversMapper
{
    const SOLVER_KEY = "solver";
    const EXAMPLES_KEY = "examples";
    const INPUT_KEY = "input";

    /**
     * @var array
     * Structure details:
     * [
     *      day-number => [
     *          part-number => [
     *              "solver" => <solver class name>,
     *              "examples" => <examples provider class name>,
     *              "input" => <input file name>,
     *          ]
     *      ]
     * ]
     */
    private $map = [
        1 => [
            1 => [
                self::SOLVER_KEY => Day01Part1Solver::class,
                self::EXAMPLES_KEY => Day01Part1Examples::class,
                self::INPUT_KEY => "day01.txt",
            ],
            2 => [
                self::SOLVER_KEY => Day01Part2Solver::class,
                self::EXAMPLES_KEY => Day01Part2Examples::class,
                self::INPUT_KEY => "day01.txt",
            ],
        ],
        2 => [
            1 => [
                self::SOLVER_KEY => Day02Part1Solver::class,
                self::EXAMPLES_KEY => Day02Part1Examples::class,
                self::INPUT_KEY => "day02.txt",
            ],
            2 => [
                self::SOLVER_KEY => Day02Part2Solver::class,
                self::EXAMPLES_KEY => Day02Part2Examples::class,
                self::INPUT_KEY => "day02.txt",
            ],
        ],
        3 => [
            1 => [
                self::SOLVER_KEY => Day03Part1Solver::class,
                self::EXAMPLES_KEY => Day03Part1Examples::class,
                self::INPUT_KEY => "day03.txt",
            ],
            2 => [
                self::SOLVER_KEY => Day03Part2Solver::class,
                self::EXAMPLES_KEY => Day03Part2Examples::class,
                self::INPUT_KEY => "day03.txt",
            ],
        ],
        4 => [
            1 => [
                self::SOLVER_KEY => Day04Part1Solver::class,
                self::EXAMPLES_KEY => Day04Part1Examples::class,
                self::INPUT_KEY => "day04.txt",
            ],
            2 => [
                self::SOLVER_KEY => Day04Part2Solver::class,
                self::EXAMPLES_KEY => Day04Part2Examples::class,
                self::INPUT_KEY => "day04.txt",
            ],
        ],
    ];

    /**
     * @param int $day
     * @param int $part
     *
     * @return string
     * @throws InvalidArgumentException
     */
    public function getSolverClassname($day, $part)
    {
        if (
            !array_key_exists($day, $this->map)
            || !array_key_exists($part, $this->map[$day])
            || !array_key_exists(self::SOLVER_KEY, $this->map[$day][$part])
        ) {
            throw new InvalidArgumentException("Could not find Solver class for Day {$day}, Part {$part}.");
        }

        return $this->map[$day][$part][self::SOLVER_KEY];
    }

    /**
     * @param int $day
     * @param int $part
     *
     * @return string
     * @throws InvalidArgumentException
     */
    public function getExamplesProviderClassname($day, $part)
    {
        if (
            !array_key_exists($day, $this->map)
            || !array_key_exists($part, $this->map[$day])
            || !array_key_exists(self::EXAMPLES_KEY, $this->map[$day][$part])
        ) {
            throw new InvalidArgumentException("Could not find ExamplesProvider class for Day {$day}, Part {$part}.");
        }

        return $this->map[$day][$part][self::EXAMPLES_KEY];
    }

    /**
     * @param int $day
     * @param int $part
     *
     * @return string
     * @throws InvalidArgumentException
     */
    public function getInputFilename($day, $part)
    {
        if (
            !array_key_exists($day, $this->map)
            || !array_key_exists($part, $this->map[$day])
            || !array_key_exists(self::INPUT_KEY, $this->map[$day][$part])
        ) {
            throw new InvalidArgumentException("Could not find Input filename for Day {$day}, Part {$part}.");
        }

        return $this->map[$day][$part][self::INPUT_KEY];
    }
}
