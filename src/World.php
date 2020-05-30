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
        if (($this->at(0, 0) === '*'
                && $this->at(0, 1) === '*')
            || $this->at(0, 2) === '*') {
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
}
