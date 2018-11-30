<?php

namespace AdventOfCode2017\Tests\Runnable;

use DirectoryIterator;
use PHPUnit\Framework\TestCase;

class RunnableFilesTest extends TestCase
{
    private static $RUNNABLE_DIR_PATH;

    public function testAllRunnableFilesPrintLessThan10Characters()
    {
        $runnableDirPath = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "runnable";
        $runnableFilename = "02-checksum-part2.php";
        $output = shell_exec("cd {$runnableDirPath} && php {$runnableFilename}");

        $errorMessage = "Output was bigger than 10 characters which most likely means it was an error."
            . "\nFile name: {$runnableFilename}" . "\nOutput: {$output}";

        $this->assertLessThan(10, strlen($output), $errorMessage);
    }

//    /**
//     * @dataProvider providerRunnableFiles
//     */
//    public function testAllRunnableFilesPrintLessThan10Characters($runnableFilename)
//    {
//        $runnableDirPath = self::$RUNNABLE_DIR_PATH;
//        $output = shell_exec("cd {$runnableDirPath} && php {$runnableFilename}");
//
//        $errorMessage = "Output was bigger than 10 characters which most likely means it was an error."
//            . "\nFile name: {$runnableFilename}" . "\nOutput: {$output}";
//
//        $this->assertLessThan(10, strlen($output), $errorMessage);
//    }
//
//    public function providerRunnableFiles()
//    {
//        $dataProviderArray = [];
//
//        self::$RUNNABLE_DIR_PATH = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "runnable";
//        $knownForFailingList = [
//            "03-spiral-matrix-part2.php",
//        ];
//
//        foreach (new DirectoryIterator(self::$RUNNABLE_DIR_PATH) as $file) {
//            $filename = $file->getFilename();
//
//            if ($file->isFile() && $file->getExtension() === "php" && !in_array($filename, $knownForFailingList, true)) {
//                $dataProviderArray["running {$filename}"] = [$filename];
//            }
//        }
//
//        return $dataProviderArray;
//    }
}