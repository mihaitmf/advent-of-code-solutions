<?php

namespace AdventOfCode\Common;

use Exception;
use InvalidArgumentException;

class SolutionRunner
{
    private static $INPUTS_DIRECTORY;

    /** @var DaysSolversMapper */
    private $mapper;

    public function __construct(DaysSolversMapper $mapper)
    {
        $this->mapper = $mapper;
        self::$INPUTS_DIRECTORY = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "inputs";
    }

    /**
     * @param int $year
     * @param int $day
     * @param int $part
     *
     * @return string
     * @throws Exception
     */
    public function run($year, $day, $part)
    {
        if (
            !is_numeric($year) || $year < 2017 || $year > 2018
            || !is_numeric($day) || $day < 1 || $day > 25
            || !is_numeric($part) || $part < 1 || $part > 2
        ) {
            throw new InvalidArgumentException("Invalid arguments for solution runner!"
                . " First argument is the Year of the event, must be an integer between 2017 - 2018."
                . " Second argument is the Day of the problem, must be an integer between 1 - 25."
                . " Third argument is the Part of the problem, must be an integer between 1 - 2."
            );
        }

        $solverClass = $this->mapper->getSolverClassname($year, $day, $part);

        /** @var Solver $solver */
        $solver = new $solverClass();

        $this->runSolutionAgainstExamples($year, $day, $part, $solver);

        $input = $this->getProblemInput($year, $day, $part);

        return $solver->solve($input);
    }

    /**
     * @param int $year
     * @param int $day
     * @param int $part
     * @param Solver $solver
     *
     * @return void
     * @throws Exception
     */
    private function runSolutionAgainstExamples($year, $day, $part, Solver $solver)
    {
        $examplesProviderClass = $this->mapper->getExamplesProviderClassname($year, $day, $part);

        /** @var ExamplesProvider $examplesProvider */
        $examplesProvider = new $examplesProviderClass();

        foreach ($examplesProvider->getExamples() as $index => $example) {
            $solverOutput = $solver->solve($example->getInput());

            if ($solverOutput !== $example->getOutput()) {
                throw new Exception(
                    "Error in example #{$index}, got output: {$solverOutput}, expected: {$example->getOutput()}"
                );
            }
        }
    }

    /**
     * @param int $year
     * @param int $day
     * @param int $part
     *
     * @return string
     * @throws InvalidArgumentException
     */
    private function getProblemInput($year, $day, $part)
    {
        $inputFilename = $this->mapper->getInputFilename($year, $day, $part);
        $inputFilePath = self::$INPUTS_DIRECTORY . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $inputFilename;

        if (!is_file($inputFilePath)) {
            throw new InvalidArgumentException("Input file {$inputFilePath} not found");
        }

        $input = file_get_contents($inputFilePath);

        if ($input === false) {
            throw new InvalidArgumentException("Error reading input file {$inputFilePath}");
        }

        return trim($input);
    }
}
