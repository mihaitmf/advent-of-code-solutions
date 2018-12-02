<?php

namespace AdventOfCode\Common;

class DaysSolversMapper
{
    const SOLVER_KEY = "solver";
    const EXAMPLES_KEY = "examples";
    const INPUT_KEY = "input";

    /**
     * @var array
     * Structure details:
     * [
     *      event-year-number => [
     *          day-number => [
     *              part-number => [
     *                  "solver" => <solver class name>,
     *                  "examples" => <examples provider class name>,
     *              ],
     *              "input" => <input file name>,
     *          ]
     *      ]
     * ]
     */
    private $map = [
//        2017 => [
//            1 => [
//                1 => [
//                    self::SOLVER_KEY => Day01Part1Solver::class,
//                    self::EXAMPLES_KEY => Day01Part1Examples::class,
//                ],
//                self::INPUT_KEY => "day01.txt",
//            ],
//        ],
    ];

    /**
     * @param int $year
     * @param int $day
     * @param int $part
     *
     * @return string
     */
    public function getSolverClassname($year, $day, $part)
    {
        if (
            array_key_exists($year, $this->map)
            && array_key_exists($day, $this->map[$year])
            && array_key_exists($part, $this->map[$year][$day])
            && array_key_exists(self::SOLVER_KEY, $this->map[$year][$day][$part])
        ) {
            return $this->map[$year][$day][$part][self::SOLVER_KEY];
        }

        return sprintf("AdventOfCode\\Event%d\\Day%02d\\Day%02dPart%dSolver", $year, $day, $day,  $part);
    }

    /**
     * @param int $year
     * @param int $day
     * @param int $part
     *
     * @return string
     */
    public function getExamplesProviderClassname($year, $day, $part)
    {
        if (
            array_key_exists($year, $this->map)
            && array_key_exists($day, $this->map[$year])
            && array_key_exists($part, $this->map[$year][$day])
            && array_key_exists(self::EXAMPLES_KEY, $this->map[$year][$day][$part])
        ) {
            return $this->map[$year][$day][$part][self::EXAMPLES_KEY];
        }

        return sprintf("AdventOfCode\\Event%d\\Day%02d\\Day%02dPart%dExamples", $year, $day, $day,  $part);
    }

    /**
     * @param int $year
     * @param int $day
     *
     * @return string
     */
    public function getInputFilePath($year, $day)
    {
        $inputsDirectoryPath = "inputs" . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR;

        if (
            array_key_exists($year, $this->map)
            && array_key_exists($day, $this->map[$year])
            && array_key_exists(self::INPUT_KEY, $this->map[$year][$day])
        ) {
            return $inputsDirectoryPath . $this->map[$year][$day][self::INPUT_KEY];
        }

        return $inputsDirectoryPath . sprintf("day%02d.txt", $day);
    }
}
