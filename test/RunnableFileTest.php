<?php

namespace AdventOfCode2017\Tests;

use DirectoryIterator;
use PHPUnit\Framework\TestCase;

class RunnableFileTest extends TestCase
{
    /**
     * @dataProvider providerImplementedSolutions
     */
    public function testRunFilePrintsLessThan10Characters($day, $part)
    {
        $runnerFilePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . "run.php";

        $output = shell_exec("php {$runnerFilePath} {$day} {$part}");

        $errorMessage = "Output was bigger than 10 characters which most likely means it was an error."
            . "\nRunning for Day {$day}, Part {$part}"
            . "\nOutput: {$output}";

        $this->assertLessThan(10, strlen($output), $errorMessage);
    }

    public function providerImplementedSolutions()
    {
        $dataProviderArray = [];

        $knownForFailingSolvers = [
            "Day03Part2Solver.php",
        ];

        $srcPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . "src";
        foreach (new DirectoryIterator($srcPath) as $fileInsideSrc) {
            $fileInsideSrcName = $fileInsideSrc->getFilename();

            if ($fileInsideSrc->isDir() && preg_match("/^Day([0-2][0-9])$/", $fileInsideSrcName, $matches) === 1) {
                $dayDirectoryPath = $srcPath . DIRECTORY_SEPARATOR . $fileInsideSrcName;
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
