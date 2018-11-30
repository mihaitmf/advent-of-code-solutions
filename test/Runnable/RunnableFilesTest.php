<?php

namespace AdventOfCode2017\Tests\Runnable;

use DirectoryIterator;
use PHPUnit\Framework\TestCase;

class RunnableFilesTest extends TestCase
{
    public function testAllRunnableFilesPrintLessThan10Characters()
    {
        $runnableDirPath = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "runnable";
        $knownForFailingList = [
            "03-spiral-matrix-part2.php",
        ];

        foreach (new DirectoryIterator($runnableDirPath) as $file) {
            $filename = $file->getFilename();

            if ($file->isFile() && $file->getExtension() === "php" && !in_array($filename, $knownForFailingList, true)) {
                $output = shell_exec("cd {$runnableDirPath} && php {$filename}");
                $this->assertLessThan(
                    10,
                    strlen($output),
                    "Output was bigger than 10 characters which most likely means it was an error.\nFile name: {$filename}\nOutput: {$output}"
                );
            }
        }
    }
}