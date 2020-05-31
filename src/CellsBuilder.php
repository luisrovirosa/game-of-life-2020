<?php

declare(strict_types = 1);

namespace Katas;

class CellsBuilder
{
    /** @var Cell[][] */
    private array $cells;

    public function __construct(int $numberOfRows, int $numberOfCols)
    {
        $stringCells = array_fill(0, $numberOfRows, array_fill(0, $numberOfCols, '.'));
        $this->withCells($stringCells);
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

    public function withCells(array $stringCells): self
    {
        foreach ($stringCells as $rowPosition => $rowContent) {
            foreach ($rowContent as $colPosition => $cellValue) {
                $cell = $cellValue === '*' ? Cell::alive() : Cell::dead();
                $this->setCell($rowPosition, $colPosition, $cell);
            }
        }

        return $this;
    }
}
