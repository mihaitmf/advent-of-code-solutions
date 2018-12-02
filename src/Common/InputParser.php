<?php

namespace AdventOfCode\Common;

class InputParser
{
    /**
     * @param string $input
     *
     * @return string[]
     */
    public function parseRows($input)
    {
        return explode("\n", $input);
    }

    /**
     * @param string $input
     *
     * @return string[]
     */
    public function parseItemsByTab($input)
    {
        return explode("\t", $input);
    }

    /**
     * @param string $input
     *
     * @return string[]
     */
    public function parseItemsBySpace($input)
    {
        return explode(" ", $input);
    }

    /**
     * @param string $input
     *
     * @return string[][]
     */
    public function parseMatrix($input)
    {
        $matrix = [];
        $rows = parseRows($input);

        foreach ($rows as $row) {
            $matrix[] = parseItemsByTab($row);
        }

        return $matrix;
    }
}
