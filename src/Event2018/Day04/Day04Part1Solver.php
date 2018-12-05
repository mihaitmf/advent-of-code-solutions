<?php

namespace AdventOfCode\Event2018\Day04;

use AdventOfCode\Common\InputParser;
use AdventOfCode\Common\Solver;
use DI\Annotation\Inject;
use RuntimeException;

/**
 * http://adventofcode.com/2018/day/4
 *

 */
class Day04Part1Solver implements Solver
{
    /**
     * @Inject
     * @var InputParser
     */
    private $inputParser;

    /**
     * @param string $input
     *
     * @return string
     */
    public function solve($input)
    {
        $items = $this->inputParser->parseRows($input);

        $itemsByDate = [];

        foreach ($items as $item) {
            $matches = [];
            $matchResult = preg_match("/^\[\d{4}-(\d+-\d+ \d\d:\d\d)\] (.*)/", $item, $matches);
            if ($matchResult !== 1) {
                throw new RuntimeException("Could not parse input");
            }

            $itemsByDate[$matches[1]] = $matches[2];
        }

        $sortedDates = array_keys($itemsByDate);
        sort($sortedDates);
        var_dump($sortedDates);
    }
}
