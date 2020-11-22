<?php

namespace AdventOfCode\Common\Runner;

use AdventOfCode\Common\Container;
use AdventOfCode\Common\ExamplesProvider;
use AdventOfCode\Common\Solver;
use Exception;
use InvalidArgumentException;

class SolutionRunner
{
    /** @var DaysSolversMapper */
    private $mapper;

    public function __construct(DaysSolversMapper $mapper)
    {
        $this->mapper = $mapper;
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
            !is_numeric($year) || $year < 2017
            || !is_numeric($day) || $day < 1 || $day > 25
            || !is_numeric($part) || $part < 1 || $part > 2
        ) {
            throw new InvalidArgumentException("Invalid arguments for solution runner!"
                . " First argument is the Year of the event, must be an integer greater than or equal to 2017."
                . " Second argument is the Day of the problem, must be an integer between 1 - 25."
                . " Third argument is the Part of the problem, must be an integer between 1 - 2."
            );
        }

        $solverClass = $this->mapper->getSolverClassname($year, $day, $part);

        /** @var Solver $solver */
        $solver = Container::get($solverClass);

        $this->runSolutionAgainstExamples($year, $day, $part, $solver);

        $input = $this->getProblemInput($year, $day);

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
        $examplesProvider = Container::get($examplesProviderClass);

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
     *
     * @return string
     * @throws InvalidArgumentException
     */
    private function getProblemInput($year, $day)
    {
        $projectRootDirectoryPath = dirname(dirname(dirname(__DIR__)));
        $inputFilePath = $this->mapper->getInputFilePath($year, $day);
        $absoluteInputFilePath = $projectRootDirectoryPath . DIRECTORY_SEPARATOR . $inputFilePath;

        if (!is_file($absoluteInputFilePath)) {
            throw new InvalidArgumentException("Input file {$absoluteInputFilePath} not found");
        }

        $input = file_get_contents($absoluteInputFilePath);

        if ($input === false) {
            throw new InvalidArgumentException("Error reading input file {$absoluteInputFilePath}");
        }

        return rtrim($input);
    }
}
