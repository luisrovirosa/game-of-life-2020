<?php

declare(strict_types = 1);

namespace Katas;

class Clock
{
    public function wait(int $miliseconds): void
    {
        usleep(100 * 1000);
    }
}
