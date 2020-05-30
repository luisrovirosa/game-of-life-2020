<?php

declare(strict_types = 1);

namespace Katas;

class World
{
    /** @var Cell[][] */
    private array $cells;

    public function __construct(array $cells)
    {
        $this->cells = $cells;
    }

    public function nextGeneration(): World
    {
        $worldBuilder = new WorldBuilder();
        $originalCell = $this->cells[1][1];
        $cell = $originalCell->nextGeneration($this->numberOfNeighbors(1, 1));
        $worldBuilder->setCell(1, 1, $cell);

        return $worldBuilder->build();
    }

    public function isAlive(int $row, int $col): bool
    {
        return $this->cells[$row][$col]->isAlive();
    }

    protected function numberOfNeighbors(int $row, int $col): int
    {
        $isAliveFilter = fn($neighborPosition): bool => $this->cells[$neighborPosition['row']][$neighborPosition['col']]->isAlive();

        return count(array_filter($this->neighbors($row, $col), $isAliveFilter));
    }

    protected function neighbors(int $row, int $col): array
    {
        return [
            ['row' => 0, 'col' => 0],
            ['row' => 0, 'col' => 1],
            ['row' => 0, 'col' => 2],
            ['row' => 1, 'col' => 0],
            ['row' => 1, 'col' => 2],
            ['row' => 2, 'col' => 0],
            ['row' => 2, 'col' => 1],
            ['row' => 2, 'col' => 2],
        ];
    }

    public function toString(): string
    {
        $cellsToStringReducer = fn(?string $carry, Cell $cell): string => $carry . $cell->toString();
        $rowOfCellsToStringMapper = fn(array $row): string => array_reduce($row, $cellsToStringReducer);

        return implode(PHP_EOL, array_map($rowOfCellsToStringMapper, $this->cells));
    }
}
