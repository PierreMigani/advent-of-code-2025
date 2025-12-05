<?php

namespace Service;

interface DayInterface {
    public function parse(array $inputLines): void;

    public function computePartOne(): mixed;

    public function computePartTwo(): mixed;
}
