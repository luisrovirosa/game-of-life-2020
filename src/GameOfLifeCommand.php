<?php

declare(strict_types = 1);

namespace Katas;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GameOfLifeCommand extends Command
{
    protected static $defaultName = 'gof:run';

    protected function configure()
    {
        $this->setDescription('Runs the Game of life kata');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gameOfLife = new GameOfLife();

        $gameOfLife->run();
        $gameOfLife->print($output);

        return 0;
    }
}
