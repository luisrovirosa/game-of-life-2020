<?php

declare(strict_types = 1);

namespace Katas;

class Cell
{
    private string $state;

    public function __construct(string $state)
    {
        $this->state = $state;
    }
}
