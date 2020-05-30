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
        $this->cells = (new CellsBuilder($stringCells))->build();
    }

    public function aliveAt(int $row, int $col): self
    {
        $this->setCell($row, $col, Cell::alive());

        return $this;
    }

    public function setCell(int $row, int $col, Cell $cell): self
    {
        $this->cells[$row][$col] = $cell;

        return $this;
    }

    public function build(): World
    {
        return new World($this->cells);
    }
}
