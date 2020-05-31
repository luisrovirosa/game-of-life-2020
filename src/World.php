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
        $this->neighborFinder = new NeighborFinder(3, 3);
    }

    public function nextGeneration(): World
    {
        $worldBuilder = new WorldBuilder();
        foreach ($this->cells as $numberOfRow => $row) {
            foreach ($row as $numberOfCol => $cell) {
                $nextGenerationCell = $cell->nextGeneration($this->numberOfAliveNeighbors($numberOfRow, $numberOfCol));
                $worldBuilder->setCell($numberOfRow, $numberOfCol, $nextGenerationCell);
            }
        }

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

    public function numberOfAliveNeighbors(int $row, int $col): int
    {
        $isAliveFilter = fn($neighborPosition): bool => $this->cells[$neighborPosition['row']][$neighborPosition['col']]->isAlive();

        return count(array_filter($this->neighborFinder->find($row, $col), $isAliveFilter));
    }
}
