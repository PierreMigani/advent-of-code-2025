<?php

namespace Service;

use Day01\Adapter\NewerSecurityProtocolPasswordResolver;
use Day01\Adapter\SecurityProtocolPasswordResolver;
use Day01\Application\Dial;
use Day01\Factory\LeftTurnDocumentLine;
use Day01\Factory\RightTurnDocumentLine;

class Day01Service implements DayInterface {
    private Dial $dial;

    public function __construct() {
        $this->dial = new Dial();
    }

    public function parse(array $inputLines): void {
        foreach ($inputLines as $line) {
            $turnSymbol = $line[0] ?? null;
            if ($turnSymbol === null) {
                throw new \InvalidArgumentException("Empty line encountered");
            }

            $turnValue = (int) substr($line, 1) ?? 0;
            if ($turnValue <= 0) {
                throw new \InvalidArgumentException("Invalid turn value: $turnValue");
            }

            $documentLine = match ($turnSymbol) {
                'L' => new LeftTurnDocumentLine($this->dial, $turnValue),
                'R' => new RightTurnDocumentLine($this->dial, $turnValue),
                default => throw new \InvalidArgumentException("Invalid turn symbol: $turnSymbol"),
            };

            $documentLine->createAction()->turnDial();
        }
    }

    public function computePartOne(): int {
        return new SecurityProtocolPasswordResolver($this->dial)->resolvePassword();
    }

    public function computePartTwo(): int {
        return new NewerSecurityProtocolPasswordResolver($this->dial)->resolvePassword();
    }
}
