<?php

declare(strict_types = 1);

namespace Katas;

class WorldBuilder
{
    private array $cells;

    public function __construct(array $cells = null)
    {
        $this->cells = $cells ?? [
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
        return new World(array_map(fn(array $row): array => array_map(fn(string $cell): Cell => new Cell($cell), $row), $this->cells));
    }
}
