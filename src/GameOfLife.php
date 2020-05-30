<?php

namespace Katas;

use Symfony\Component\Console\Output\OutputInterface;

class GameOfLife
{
    private World $world;

    public function __construct(array $world)
    {
        $this->world = new World(array_map(fn(array $row): array => array_map(fn(string $cell): Cell => new Cell($cell), $row), $world));
    }

    public function run(): void
    {
        $this->world = $this->world->nextGeneration();
    }

    public function print(OutputInterface $output): void
    {
        $this->world->print($output);
    }
}
