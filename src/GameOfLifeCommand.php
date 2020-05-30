<?php

declare(strict_types = 1);

namespace Katas;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GameOfLifeCommand extends Command
{
    protected static $defaultName = 'gof:run';
    private Clock $clock;

    public function __construct(Clock $clock = null)
    {
        parent::__construct(null);
        $this->clock = $clock ?? new Clock();
    }

    protected function configure()
    {
        $this->setDescription('Runs the Game of life kata')
             ->addArgument('world', InputArgument::OPTIONAL, "The initial world as string", "... ... ...")
             ->addOption('generations', 'g', InputOption::VALUE_OPTIONAL, 'The number of generations created', 10)
             ->addOption('time_between_generations', 't', InputOption::VALUE_OPTIONAL, 'Time in milliseconds wait when printing generations', 1000);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $gameOfLife = new GameOfLife($this->initialWorld($input));
        $this->printGameOfLife("\nGeneration Initial", $gameOfLife, $output);
        $numberOfGenerations = (int) $input->getOption('generations');
        for ($currentGeneration = 1; $currentGeneration <= $numberOfGenerations; $currentGeneration++) {
            $this->clock->wait((int) $input->getOption('time_between_generations'));
            $gameOfLife->run();
            $this->printGameOfLife("\nGeneration $currentGeneration", $gameOfLife, $output);
        }

        return 0;
    }

    protected function initialWorld(InputInterface $input): array
    {
        $worldAsString = $input->getArgument('world');

        return array_map(fn($file) => str_split($file), explode(' ', $worldAsString));
    }

    protected function printGameOfLife(string $header, GameOfLife $gameOfLife, OutputInterface $output): void
    {
        $output->writeln($header);
        $output->write($gameOfLife->toString());
    }
}
