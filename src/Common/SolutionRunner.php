<?php
namespace AdventOfCode2017\Common;

use Exception;

class SolutionRunner
{
    /** @var Solver */
    private $solver;

    public function __construct(Solver $solver)
    {
        $this->solver = $solver;
    }

    /**
     * @param string $input
     * @return string
     * @throws Exception
     */
    public function run($input)
    {
        foreach ($this->solver->getExamples() as $index => $example) {
            $solverOutput = $this->solver->solve($example->getInput());
            if ($solverOutput != $example->getOutput()) {
                throw new Exception(
                    "Error in example #{$index}, got output: {$solverOutput}, expected: {$example->getOutput()}"
                );
            }
        }

        return $this->solver->solve($input);
    }
}