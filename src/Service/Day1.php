<?php

namespace Service;

/**
 * Example implementation for Day 1 - This is a template for creating day solutions
 * Replace this with your actual solution logic
 */
class Day1 implements DayInterface {
    private array $data = [];

    public function parse(array $inputLines): void
    {
        // Parse the input data
        // Example: store each line in the data array
        $this->data = $inputLines;
    }

    public function computePartOne(): mixed
    {
        // Implement your solution for part one here
        // This is just an example - replace with actual logic
        return "Part 1 not implemented yet - input lines: " . count($this->data);
    }

    public function computePartTwo(): mixed
    {
        // Implement your solution for part two here
        // This is just an example - replace with actual logic
        return "Part 2 not implemented yet - input lines: " . count($this->data);
    }
}
