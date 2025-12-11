<?php

namespace Day01\Factory;

use Day01\Command\TurnDialAction;
use Day01\Command\TurnDialRight;

final class RightTurnDocumentLine extends IndicationsDocumentLine {
    public function createAction(): TurnDialAction
    {
        return new TurnDialRight($this->dial, $this->indicatedTurn);
    }
}