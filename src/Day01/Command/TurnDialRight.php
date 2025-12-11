<?php

namespace Day01\Command;

final class TurnDialRight extends TurnDialAction {
    public function turnDial(): void
    {
        $this->dial->turnRight($this->turnValue);
    }
}