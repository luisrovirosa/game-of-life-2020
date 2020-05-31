<?php

declare(strict_types = 1);

namespace Katas;

class WorldBuilder
{
    private CellsBuilder $cellsBuilder;

    public function __construct()
    {
        $this->cellsBuilder = new CellsBuilder(3, 3);
    }

    public function aliveAt(int $row, int $col): self
    {
        $this->cellsBuilder->aliveAt($row, $col);

        return $this;
    }

    public function setCell(int $row, int $col, Cell $cell): self
    {
        $this->cellsBuilder->setCell($row, $col, $cell);

        return $this;
    }

    public function withAliveCells(array $neighbors): self
    {
        $this->cellsBuilder->withAliveCells($neighbors);

        return $this;
    }

    public function withCells(?array $cells): self
    {
        $this->cellsBuilder->withCells($cells);

        return $this;
    }

    public function build(): World
    {
        return new World($this->cellsBuilder->build());
    }
}
