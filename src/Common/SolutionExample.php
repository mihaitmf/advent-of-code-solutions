<?php
namespace AdventOfCode2017\Common;

class SolutionExample
{
    /** @var string */
    private $input;

    /** @var string */
    private $output;

    private function __construct() {}

    /**
     * @param string $input
     * @param string $output
     *
     * @return SolutionExample
     */
    public static function of($input, $output)
    {
        $example = new self();
        $example->input = $input;
        $example->output = $output;

        return $example;
    }

    /**
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }
}
