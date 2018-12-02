<?php

namespace AdventOfCode\Tests;

use DirectoryIterator;
use PHPUnit\Framework\TestCase;

class RunnableFileTest extends TestCase
{
    /**
     * @dataProvider providerImplementedSolutionsFor2017Event
     */
    public function testRunFilePrintsLessThan10CharactersFor2017Event($day, $part)
    {
        $runnerFilePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . "run.php";

        $output = shell_exec("php {$runnerFilePath} 2017 {$day} {$part}");

        $errorMessage = "Output was bigger than 10 characters which most likely means it was an error."
            . "\nRunning for Day {$day}, Part {$part}"
            . "\nOutput: {$output}";

        $this->assertLessThan(10, strlen($output), $errorMessage);
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
    public function testRunFilePrintsLessThan10CharactersFor2018Event($day, $part)
    {
        $runnerFilePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . "run.php";

        $output = shell_exec("php {$runnerFilePath} 2018 {$day} {$part}");

        $errorMessage = "Output was bigger than 10 characters which most likely means it was an error."
            . "\nRunning for Day {$day}, Part {$part}"
            . "\nOutput: {$output}";

        $this->assertLessThan(10, strlen($output), $errorMessage);
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
                        $dataProviderArray["running solution for Day {$dayNumberAsInt} Part {$partAsInt}"] = [$dayNumberAsInt, $partAsInt];
                    }
                }

            }
        }

        return $dataProviderArray;
    }
}
