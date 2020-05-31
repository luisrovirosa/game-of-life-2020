<?php

declare(strict_types = 1);

namespace Katas;

class CellsBuilder
{
    private $cells;

    public function __construct(array $cells = null)
    {
        $stringCells = $cells ?? array_fill(0, 3, array_fill(0, 3, '.'));

        $this->cells = array_map(fn(array $row): array => array_map(fn(string $cell): Cell => $cell === '*' ? Cell::alive() : Cell::dead(), $row), $stringCells);
    }

    /**
     * @return Cell[][]
     */
    public function build(): array
    {
        return $this->cells;
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

    public function withAliveCells(array $neighbors): self
    {
        array_map(fn(array $neighbor) => $this->aliveAt($neighbor[0], $neighbor[1]), $neighbors);

        return $this;
    }
}
