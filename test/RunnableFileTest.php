<?php

namespace AdventOfCode\Tests;

use DirectoryIterator;
use PHPUnit\Framework\TestCase;

class RunnableFileTest extends TestCase
{
    /**
     * @dataProvider providerImplementedSolutionsFor2017Event
     */
    public function testRunFileDoesNotPrintErrorFor2017Event($day, $part)
    {
        $output = $this->executeRunnerCommand(2017, $day, $part, $this->getRunnerFilePath());

        $this->assertNotErrorOutput(2017, $day, $part, $output);
    }

    public function providerImplementedSolutionsFor2017Event()
    {
        $knownForFailingSolvers = [
            "Day03Part2Solver.php",
        ];

        $dayParentDirectoryPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "Event2017";

        return $this->getImplementedSolutions($dayParentDirectoryPath, $knownForFailingSolvers);
    }

    /**
     * @dataProvider providerImplementedSolutionsFor2018Event
     */
    public function testRunFileDoesNotPrintErrorFor2018Event($day, $part)
    {
        $output = $this->executeRunnerCommand(2018, $day, $part, $this->getRunnerFilePath());

        $this->assertNotErrorOutput(2018, $day, $part, $output);
    }

    public function providerImplementedSolutionsFor2018Event()
    {
        $knownForFailingSolvers = [];
        $dayParentDirectoryPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "Event2018";

        return $this->getImplementedSolutions($dayParentDirectoryPath, $knownForFailingSolvers);
    }

    /**
     * @param string $dayParentDirectoryPath
     * @param string[] $knownForFailingSolvers
     *
     * @return array
     */
    private function getImplementedSolutions($dayParentDirectoryPath, array $knownForFailingSolvers)
    {
        $dataProviderArray = [];

        foreach (new DirectoryIterator($dayParentDirectoryPath) as $dayDirectory) {
            $dayDirectoryName = $dayDirectory->getFilename();

            if ($dayDirectory->isDir() && preg_match("/^Day([0-2][0-9])$/", $dayDirectoryName, $matches) === 1) {
                $dayDirectoryPath = $dayParentDirectoryPath . DIRECTORY_SEPARATOR . $dayDirectoryName;
                $dayNumberString = $matches[1];

                foreach (new DirectoryIterator($dayDirectoryPath) as $fileInsideDay) {
                    $dayFileName = $fileInsideDay->getFilename();

                    if (
                        $fileInsideDay->isFile()
                        && preg_match("/^Day{$dayNumberString}Part([1-2])Solver.php$/", $dayFileName, $matches) === 1
                        && !in_array($dayFileName, $knownForFailingSolvers, true)
                    ) {
                        $partAsInt = (int)$matches[1];
                        $dayNumberAsInt = (int)$dayNumberString;
                        $dataProviderArray["running solution for Day {$dayNumberAsInt} Part {$partAsInt}"] =
                            [$dayNumberAsInt, $partAsInt];
                    }
                }

            }
        }

        return $dataProviderArray;
    }

    /**
     * @return string
     */
    private function getRunnerFilePath()
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . "run.php";
    }

    /**
     * @param int $year
     * @param int $day
     * @param int $part
     * @param string $runnerFilePath
     *
     * @return string
     */
    private function executeRunnerCommand($year, $day, $part, $runnerFilePath)
    {
        return shell_exec(sprintf("php %s %d %d %d", $runnerFilePath, $year, $day, $part));
    }

    /**
     * @param int $year
     * @param int $day
     * @param int $part
     * @param string $output
     *
     * @return void
     */
    private function assertNotErrorOutput($year, $day, $part, $output)
    {
        $errorMessage = $this->getCommonErrorMessage($year, $day, $part, $output);

        $this->assertGreaterThan(1, strlen($output), $errorMessage);
        $this->assertSame(0, substr_count($output, "\n"), $errorMessage);
        $this->assertLessThan(30, strlen($output), $errorMessage);
    }

    /**
     * @param int $year
     * @param int $day
     * @param int $part
     * @param string $output
     *
     * @return string
     */
    private function getCommonErrorMessage($year, $day, $part, $output)
    {
        return "Output was empty or bigger than expected which most likely means it was an error."
            . "\nRunning problem for Event {$year}, Day {$day}, Part {$part}"
            . "\nOutput: {$output}";
    }
}
