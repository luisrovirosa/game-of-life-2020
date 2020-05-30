<?php

declare(strict_types = 1);

namespace Katas;

class World
{
    /** @var Cell[][] */
    private array $cells;
    private NeighborFinder $neighborFinder;

    public function __construct(array $cells)
    {
        $this->cells = $cells;
        $this->neighborFinder = new NeighborFinder($this->cells);
    }

    public function nextGeneration(): World
    {
        $worldBuilder = new WorldBuilder();
        $originalCell = $this->cells[1][1];
        $cell = $originalCell->nextGeneration($this->neighborFinder->numberOfAliveNeighbors(1, 1));
        $worldBuilder->setCell(1, 1, $cell);

        return $worldBuilder->build();
    }

    public function isAlive(int $row, int $col): bool
    {
        return $this->cells[$row][$col]->isAlive();
    }

    public function toString(): string
    {
        $cellsToStringReducer = fn(?string $carry, Cell $cell): string => $carry . $cell->toString();
        $rowOfCellsToStringMapper = fn(array $row): string => array_reduce($row, $cellsToStringReducer);

        return implode(PHP_EOL, array_map($rowOfCellsToStringMapper, $this->cells));
    }
}
