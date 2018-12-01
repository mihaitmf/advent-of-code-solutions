<?php
namespace AdventOfCode2017\Tests\Common;

use AdventOfCode2017\Common\DaysSolversMapper;
use AdventOfCode2017\Common\SolutionRunner;
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
        ];
    }
}
