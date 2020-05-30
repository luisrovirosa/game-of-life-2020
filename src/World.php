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
        $cell = $originalCell->nextGeneration($this->numberOfNeighbors());
        $worldBuilder->setCell(1, 1, $cell);

        return $worldBuilder->build();
    }

    public function isAlive(int $row, int $col): bool
    {
        return $this->cells[$row][$col]->isAlive();
    }

    protected function numberOfNeighbors(): int
    {
        return count(array_filter($this->neighbors(), fn($coordinate): bool => $this->cells[$coordinate['row']][$coordinate['col']]->isAlive()));
    }

    protected function neighbors(): array
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
        $toString = '';
        foreach ($this->cells as $row) {
            $stringRow = array_reduce($row, fn(?string $carry, Cell $cell): string => $carry . $cell->toString());
            $toString .= $stringRow . PHP_EOL;
        }

        return $toString;
    }
}
