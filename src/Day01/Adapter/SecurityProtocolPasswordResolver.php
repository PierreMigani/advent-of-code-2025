<?php

namespace Day01\Adapter;

final class SecurityProtocolPasswordResolver extends SafePasswordResolver {
    public function resolvePassword(): int
    {
        $password = 0;
        foreach ($this->dial->pointedNumberHistory as $pastDialValue) {
            if ($pastDialValue === 0) {
                $password++;
            }
        }

        return $password;
    }
}