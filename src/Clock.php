<?php

declare(strict_types = 1);

namespace Katas;

class Clock
{
    public function wait(int $milliseconds): void
    {
        usleep($milliseconds * 1000);
    }
}
