<?php

declare(strict_types = 1);

namespace Katas\Tests;

class CellsBuilder
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

    public function build(): array
    {
        return $this->cells;
    }
}
