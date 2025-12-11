<?php

namespace Day01\Adapter;

final class NewerSecurityProtocolPasswordResolver extends SafePasswordResolver {
    public function resolvePassword(): int
    {
        return $this->dial->totalNumberOfClick;
    }
}