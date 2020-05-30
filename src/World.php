<?php

declare(strict_types = 1);

namespace Katas;

use Katas\Tests\CellsBuilder;
use Symfony\Component\Console\Output\OutputInterface;

class World
{
    private array $cells;

    public function __construct(array $cells)
    {
        $this->cells = $cells;
    }

    public function nextGeneration(): World
    {
        $cellsBuilder = new CellsBuilder();
        $numberOfNeighbors = $this->numberOfNeighbors();
        if ($numberOfNeighbors === 2 || $numberOfNeighbors === 3) {
            $cellsBuilder->aliveAt(1, 1);
        }

        return new World(($cellsBuilder)->build());
    }

    public function print(OutputInterface $output): void
    {
        foreach ($this->cells as $file) {
            $output->writeln(implode('', $file));
        }
    }

    public function at(int $row, int $col): string
    {
        return $this->cells[$row][$col];
    }

    protected function numberOfNeighbors(): int
    {
        return count(array_filter($this->neighbors(), fn($coordinated): bool => $this->at($coordinated['row'], $coordinated['col']) === '*'));
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
