<?php
namespace AdventOfCode2017\Common;

class SolutionExample
{
    private $input;
    private $output;

    private function __construct() {}

    public static function of($input, $output)
    {
        $example = new self();
        $example->input = $input;
        $example->output = $output;

        return $example;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function getOutput()
    {
        return $this->output;
    }
}