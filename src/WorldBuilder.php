<?php

declare(strict_types = 1);

namespace Katas;

class WorldBuilder
{
    private array $cells;

    public function __construct()
    {
        $this->cells = [
            ['.', '.', '.'],
            ['.', '.', '.'],
            ['.', '.', '.'],
        ];
    }

    public function aliveAt(int $row, int $col): self
    {
        $this->cells[$row][$col] = '*';

        return $this;
    }

    public function build(): World
    {
        return new World($this->cells);
    }
}
