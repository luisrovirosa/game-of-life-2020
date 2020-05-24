<?php

namespace Katas;

use Symfony\Component\Console\Output\OutputInterface;

class GameOfLife
{
    public function __construct()
    {
    }

    public function run(): void
    {
    }

    public function print(OutputInterface $output): void
    {
        $output->writeln('...');
        $output->writeln('...');
        $output->writeln('...');
    }
}
