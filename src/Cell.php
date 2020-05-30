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

    public function nextGeneration(int $numberOfNeighbors): Cell
    {
        if ($this->isAlive() && ($numberOfNeighbors === 2 || $numberOfNeighbors === 3)) {
            return Cell::alive();
        }
        if ($this->isDead() && $numberOfNeighbors === 3) {
            return Cell::alive();
        }

        return Cell::dead();
    }

    public function isAlive(): bool
    {
        return $this->state === '*';
    }

    public function isDead(): bool
    {
        return !$this->isAlive();
    }

    public function toString(): string
    {
        return $this->state;
    }

    public static function alive(): Cell
    {
        return new Cell('*');
    }

    public static function dead(): Cell
    {
        return new Cell('.');
    }
}
