<?php

namespace AdventOfCode\Common\Runner;

class CommandLineArgumentsParser
{
    const CONFIG_FILE_PATH = "config.ini";

    /**
     * @param string[] $argv
     *
     * @return string[]
     */
    public function parse(array $argv)
    {
        $argc = count($argv);

        // all 3 command line arguments
        if ($argc === 4) {
            $year = $argv[1];
            $day = $argv[2];
            $part = $argv[3];

        // no command line arguments, read defaults from config file
        } elseif ($argc === 1 && is_file(self::CONFIG_FILE_PATH)) {
            $config = parse_ini_file(self::CONFIG_FILE_PATH, true);
            $year = $config["runner-default"]["year"];
            $day = $config["runner-default"]["day"];
            $part = $config["runner-default"]["part"];

        } else {
            throw new \InvalidArgumentException("The solution runner requires three integer arguments: the year of the event, the day and the part of the problem. Example run solution for the 2017 event, day 9, part 2: php run.php 2017 9 2");
        }

        return [$year, $day, $part];
    }
}
