<?php

namespace Day01\Adapter;

use Day01\Application\Dial;

abstract class SafePasswordResolver {
    public function __construct(
        protected Dial $dial
    ) {}

    abstract public function resolvePassword(): int;
}