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

    public function isAlive(): bool
    {
        return $this->state === '*';
    }

    public function nextGeneration(int $numberOfNeighbors): Cell
    {
        $cell = new Cell('.');
        if ($this->isAlive() && ($numberOfNeighbors === 2 || $numberOfNeighbors === 3)) {
            $cell = new Cell('*');
        }
        if (!$this->isAlive() && $numberOfNeighbors === 3) {
            $cell = new Cell('*');
        }

        return $cell;
    }

    public function toString(): string
    {
        return $this->state;
    }
}
