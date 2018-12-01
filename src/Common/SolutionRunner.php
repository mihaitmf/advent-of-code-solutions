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
     * @param int $day
     * @param int $part
     *
     * @return string
     * @throws Exception
     */
    public function run($day, $part)
    {
        if (!is_numeric($day) || $day < 1 || $day > 25 || !is_numeric($part) || $part < 1 || $part > 2) {
            throw new InvalidArgumentException("Invalid arguments for solution runner!"
                . " First argument is the Day of the problem, must be an integer between 1 - 25."
                . " Second argument is the Part of the problem, must be an integer between 1 - 2."
            );
        }

        $solverClass = $this->mapper->getSolverClassname($day, $part);

        /** @var Solver $solver */
        $solver = new $solverClass();

        $this->runSolutionAgainstExamples($day, $part, $solver);

        $input = $this->getProblemInput($day, $part);

        return $solver->solve($input);
    }

    /**
     * @param int $day
     * @param int $part
     * @param Solver $solver
     *
     * @return void
     * @throws Exception
     */
    private function runSolutionAgainstExamples($day, $part, Solver $solver)
    {
        $examplesProviderClass = $this->mapper->getExamplesProviderClassname($day, $part);

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
     * @param int $day
     * @param int $part
     *
     * @return string
     * @throws InvalidArgumentException
     */
    private function getProblemInput($day, $part)
    {
        $inputFilename = $this->mapper->getInputFilename($day, $part);
        $inputFilePath = self::$INPUTS_DIRECTORY . DIRECTORY_SEPARATOR . $inputFilename;

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
