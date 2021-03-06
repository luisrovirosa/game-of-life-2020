<?php

declare(strict_types = 1);

namespace Katas;

class Cell
{
    private bool $isAlive;

    private function __construct(bool $isAlive)
    {
        $this->isAlive = $isAlive;
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
        return $this->isAlive;
    }

    public function isDead(): bool
    {
        return !$this->isAlive();
    }

    public function toString(): string
    {
        return $this->isAlive ? '*' : '.';
    }

    public static function alive(): Cell
    {
        return new Cell(true);
    }

    public static function dead(): Cell
    {
        return new Cell(false);
    }
}
