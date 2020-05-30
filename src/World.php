<?php

declare(strict_types = 1);

namespace Katas;

use Symfony\Component\Console\Output\OutputInterface;

class World
{
    /** @var Cell[][] */
    private array $realCells;

    public function __construct(array $cells)
    {
        $this->realCells = array_map(fn(array $row): array => array_map(fn(string $cell): Cell => new Cell($cell), $row), $cells);
    }

    public function nextGeneration(): World
    {
        $cellsBuilder = new CellsBuilder();
        $numberOfNeighbors = $this->numberOfNeighbors();
        if ($this->isAlive(1, 1) && ($numberOfNeighbors === 2 || $numberOfNeighbors === 3)) {
            $cellsBuilder->aliveAt(1, 1);
        }
        if (!$this->isAlive(1, 1) && $numberOfNeighbors === 3) {
            $cellsBuilder->aliveAt(1, 1);
        }

        return new World(($cellsBuilder)->build());
    }

    public function print(OutputInterface $output): void
    {
        foreach ($this->realCells as $row) {
            $stringRow = array_reduce($row, fn(?string $carry, Cell $cell): string => $carry . $cell->toString());
            $output->writeln($stringRow);
        }
    }

    public function isAlive(int $row, int $col): bool
    {
        return $this->realCells[$row][$col]->isAlive();
    }

    protected function numberOfNeighbors(): int
    {
        return count(array_filter($this->neighbors(), fn($coordinated): bool => $this->isAlive($coordinated['row'], $coordinated['col'])));
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
}
