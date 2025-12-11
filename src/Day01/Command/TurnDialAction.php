<?php

namespace Day01\Command;

use Day01\Application\Dial;

abstract class TurnDialAction {
    public function __construct(
        protected Dial $dial,
        protected int $turnValue
    ) {
    }

    abstract public function turnDial();
}