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
        $count = 0;
        $neighbors = [[0, 0]];
        foreach ($neighbors as $coordinated) {
            $count += $this->at(0, 0) === '*' ? 1 : 0;
        }
        $count += $this->at(0, 1) === '*' ? 1 : 0;
        $count += $this->at(0, 2) === '*' ? 1 : 0;
        $count += $this->at(1, 0) === '*' ? 1 : 0;

        return ($count === 2);
    }
}
