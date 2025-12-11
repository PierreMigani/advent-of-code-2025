<?php

namespace Day01\Application;

use Day01\Command\TurnDialAction;

class Dial {
    public const MAX_VALUE = 100;

    private int $currentPointedNumber = 50;

    public private(set) int $totalNumberOfClick = 0;

    /**
     * @var int[]
     */ 
    public private(set) array $pointedNumberHistory = [];

    public function turnLeft(int $numberOfTurns): void {
        $this->pointedNumber -= $numberOfTurns;
    }

    public function turnRight(int $numberOfTurns): void {
        $this->pointedNumber += $numberOfTurns;
    }

    public int $pointedNumber {
        set (int $turnedNumber) {
            $this->addNumberOfClicksFromTurnedNumber($turnedNumber);

            $this->changeCurrentPointedNumberFromTurnedNumber($turnedNumber);
        }

        get => $this->currentPointedNumber;
    }

    private function addNumberOfClicksFromTurnedNumber(int $turnedNumber): void
    {
        $numberOfClicksToAdd = abs($turnedNumber) / self::MAX_VALUE;

        // edge case when we change from a positive to negative value: add a click
        if ($this->currentPointedNumber > 0 && $turnedNumber <= 0) {
            $numberOfClicksToAdd++;
        }

        $this->totalNumberOfClick += $numberOfClicksToAdd;
    }

    private function changeCurrentPointedNumberFromTurnedNumber(int $turnedNumber): void
    {
        $pointedNumber = $turnedNumber % self::MAX_VALUE;
        if ($pointedNumber < 0) {
            $pointedNumber += self::MAX_VALUE;
        }

        $this->currentPointedNumber = $pointedNumber;
        $this->pointedNumberHistory[] = $pointedNumber;
    }
}