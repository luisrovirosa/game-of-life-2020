<?php

namespace Katas;

use Symfony\Component\Console\Output\OutputInterface;

class GameOfLife
{
    private OutputInterface $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function run(): void
    {
    }

    public function print(OutputInterface $output): void
    {
        $this->output->writeln('...');
        $this->output->writeln('...');
        $this->output->writeln('...');
    }
}
