<?php

namespace AdventOfCode\Tests\Common;

use AdventOfCode\Common\DaysSolversMapper;
use AdventOfCode\Common\SolutionRunner;
use PHPUnit\Framework\TestCase;

class SolutionRunnerIntegrationTest extends TestCase
{
    /** @var SolutionRunner */
    private $solutionRunner;

    protected function setUp()
    {
        $this->solutionRunner = new SolutionRunner(new DaysSolversMapper());
    }

    /**
     * @dataProvider providerSolutions
     */
    public function testRunSolutionsExpectedOutput($day, $part, $expectedResult)
    {
        $actualResult = $this->solutionRunner->run($day, $part);

        $this->assertSame($expectedResult, $actualResult, "The solution runner returned a different result");
    }

    public function providerSolutions()
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
}
