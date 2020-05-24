<?php

namespace Katas;

use Symfony\Component\Console\Output\OutputInterface;

class GameOfLife
{
    private array $world;

    public function __construct(array $world)
    {
        $this->world = $world;
    }

    public function run(): void
    {
    }

    public function print(OutputInterface $output): void
    {
        foreach ($this->world as $file) {
            $output->writeln(implode('', $file));
        }
    }
}
