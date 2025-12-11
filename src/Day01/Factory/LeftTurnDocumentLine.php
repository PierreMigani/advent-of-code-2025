<?php

namespace Day01\Factory;

use Day01\Command\TurnDialAction;
use Day01\Command\TurnDialLeft;

final class LeftTurnDocumentLine extends IndicationsDocumentLine {
    public function createAction(): TurnDialAction
    {
        return new TurnDialLeft($this->dial, $this->indicatedTurn);
    }
}