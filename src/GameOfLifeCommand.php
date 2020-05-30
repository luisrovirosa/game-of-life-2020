<?php

declare(strict_types = 1);

namespace Katas;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GameOfLifeCommand extends Command
{
    protected static $defaultName = 'gof:run';

    protected function configure()
    {
        $this->setDescription('Runs the Game of life kata')
             ->addOption('generations', 'g', InputOption::VALUE_OPTIONAL, 'The number of generations created', 10);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gameOfLife = new GameOfLife([]);

        $numberOfGenerations = (int) $input->getOption('generations');
        for ($currentGeneration = 0; $currentGeneration < $numberOfGenerations; $currentGeneration++) {
            $gameOfLife->run();
            $gameOfLife->print($output);
        }

        return 0;
    }
}
