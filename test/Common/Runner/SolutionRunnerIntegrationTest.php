<?php

namespace AdventOfCode\Tests\Common\Runner;

use AdventOfCode\Common\Container;
use AdventOfCode\Common\Runner\SolutionRunner;
use PHPUnit\Framework\TestCase;

class SolutionRunnerIntegrationTest extends TestCase
{
    /** @var SolutionRunner */
    private $solutionRunner;

    protected function setUp()
    {
        $this->solutionRunner = Container::get(SolutionRunner::class);
    }

    /**
     * @dataProvider providerSolutions2017Event
     */
    public function testRunSolutionsExpectedOutputFor2017Event($day, $part, $expectedResult)
    {
        $actualResult = $this->solutionRunner->run(2017, $day, $part);

        $this->assertSame($expectedResult, $actualResult, "The solution runner returned a different result");
    }

    public function providerSolutions2017Event()
    {
        return [
            "Day 01 Part 1" => [1, 1, "1251"],
            "Day 01 Part 2" => [1, 2, "1244"],
            "Day 02 Part 1" => [2, 1, "43074"],
            "Day 02 Part 2" => [2, 2, "280"],
            "Day 03 Part 1" => [3, 1, "419"],
//            "Day 03 Part 2" => [3, 2, "419"],
            "Day 04 Part 1" => [4, 1, "455"],
            "Day 04 Part 2" => [4, 2, "186"],
            "Day 05 Part 1" => [5, 1, "391540"],
            "Day 05 Part 2" => [5, 2, "30513679"],
            "Day 06 Part 1" => [6, 1, "11137"],
            "Day 06 Part 2" => [6, 2, "1037"],
            "Day 07 Part 1" => [7, 1, "vgzejbd"],
            "Day 07 Part 2" => [7, 2, "1226"],
            "Day 08 Part 1" => [8, 1, "6828"],
            "Day 08 Part 2" => [8, 2, "7234"],
        ];
    }

    /**
     * @dataProvider providerSolutions2018Event
     */
    public function testRunSolutionsExpectedOutputFor2018Event($day, $part, $expectedResult)
    {
        $actualResult = $this->solutionRunner->run(2018, $day, $part);

        $this->assertSame($expectedResult, $actualResult, "The solution runner returned a different result");
    }

    public function providerSolutions2018Event()
    {
        return [
            "Day 01 Part 1" => [1, 1, "472"],
            "Day 01 Part 2" => [1, 2, "66932"],
            "Day 02 Part 1" => [2, 1, "8296"],
            "Day 02 Part 2" => [2, 2, "pazvmqbftrbeosiecxlghkwud"],
            "Day 03 Part 1" => [3, 1, "105071"],
            "Day 03 Part 2" => [3, 2, "222"],
            "Day 04 Part 1" => [4, 1, "48680"],
            "Day 04 Part 2" => [4, 2, "94826"],
            "Day 05 Part 1" => [5, 1, "11476"],
            "Day 05 Part 2" => [5, 2, "5446"], // moderately slow ~14s
            "Day 08 Part 1" => [8, 1, "43996"],
            "Day 08 Part 2" => [8, 2, "35189"],
            "Day 09 Part 1" => [9, 1, "386018"],
//            "Day 09 Part 2" => [9, 2, "3085518618"], TODO segmentation fault on php 5.5
//            "Day 10 Part 1" => [10, 1, "HRPHBRKG"], TODO interpret letter drawing
            "Day 10 Part 2" => [10, 2, "10355"], // severely slow ~3m50s
            "Day 11 Part 1" => [11, 1, "243,72"],
            "Day 11 Part 2" => [11, 2, "229,192,11"], // severely slow ~3m40s
            "Day 13 Part 1" => [13, 1, "124,90"],
            "Day 13 Part 2" => [13, 2, "145,88"], // moderately slow ~4s
        ];
    }
}
