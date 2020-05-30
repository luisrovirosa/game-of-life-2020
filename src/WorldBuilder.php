<?php

declare(strict_types = 1);

namespace Katas;

class WorldBuilder
{
    /** @var Cell[][] */
    private array $cells;

    public function __construct(array $cells = null)
    {
        $stringCells = $cells ?? [
                ['.', '.', '.'],
                ['.', '.', '.'],
                ['.', '.', '.'],
            ];
        $this->cells = array_map(fn(array $row): array => array_map(fn(string $cell): Cell => new Cell($cell), $row), $stringCells);
    }

    public function aliveAt(int $row, int $col): self
    {
        $this->cells[$row][$col] = new Cell('*');

        return $this;
    }

    public function build(): World
    {
        return new World($this->cells);
    }
}
