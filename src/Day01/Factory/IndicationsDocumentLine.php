<?php

namespace Day01\Factory;

use Day01\Application\Dial;
use Day01\Command\TurnDialAction;

abstract class IndicationsDocumentLine {
    public function __construct(
        readonly protected Dial $dial,
        readonly protected int $indicatedTurn
    ) {}

    abstract public function createAction(): TurnDialAction;
}