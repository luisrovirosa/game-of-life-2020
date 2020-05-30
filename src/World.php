<?php

declare(strict_types = 1);

namespace Katas;

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
        if ($this->hasTwoNeighbors()) {
            return new World([
                ['.', '.', '.'],
                ['.', '*', '.'],
                ['.', '.', '.'],
            ]);
        }

        return new World([
            ['.', '.', '.'],
            ['.', '.', '.'],
            ['.', '.', '.'],
        ]);
    }

    public function print(OutputInterface $output)
    {
        foreach ($this->cells as $file) {
            $output->writeln(implode('', $file));
        }
    }

    public function at(int $row, int $col): string
    {
        return $this->cells[$row][$col];
    }

    protected function hasTwoNeighbors(): bool
    {
        $neighbors = [
            ['row' => 0, 'col' => 0],
            ['row' => 0, 'col' => 1],
            ['row' => 0, 'col' => 2],
            ['row' => 1, 'col' => 0],
            ['row' => 1, 'col' => 2],
            ['row' => 2, 'col' => 0],
            ['row' => 2, 'col' => 1],
            ['row' => 2, 'col' => 2],
        ];
        $numberOfNeighborsAlive = count(array_filter($neighbors, fn($coordinated): bool => $this->at($coordinated['row'], $coordinated['col']) === '*'));

        return $numberOfNeighborsAlive === 2;
    }
}
