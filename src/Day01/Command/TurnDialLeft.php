<?php

namespace Day01\Command;

final class TurnDialLeft extends TurnDialAction {
    public function turnDial(): void
    {
        $this->dial->turnLeft($this->turnValue);
    }
}