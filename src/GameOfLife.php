<?php

namespace Katas;

use Symfony\Component\Console\Output\OutputInterface;

class GameOfLife
{
    private World $world;

    public function __construct(array $world)
    {
        $this->world = new World($world);
    }

    public function run(): void
    {
    }

    public function print(OutputInterface $output): void
    {
        $this->world->print($output);
    }
}
