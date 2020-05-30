<?php

declare(strict_types = 1);

namespace Katas;

class CellsBuilder
{
    private $cells;

    public function __construct(array $stringCells)
    {
        $this->cells = array_map(fn(array $row): array => array_map(fn(string $cell): Cell => $cell === '*' ? Cell::alive() : Cell::dead(), $row), $stringCells);
    }

    /**
     * @return Cell[][]
     */
    public function build(): array
    {
        return $this->cells;
    }
}
