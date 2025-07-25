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

    public function __construct(?Clock $clock = null)
    {
        parent::__construct(null);
        $this->clock = $clock ?? new Clock();
    }

    protected function configure()
    {
        $this->setDescription('Runs the Game of life kata')
             ->addArgument('world', InputArgument::OPTIONAL, "The initial world as string", "... ... ...")
             ->addOption('generations', 'g', InputOption::VALUE_OPTIONAL, 'The number of generations created', 10)
             ->addOption('time_between_generations', 't', InputOption::VALUE_OPTIONAL, 'Time in milliseconds wait when printing generations', 1000)
             ->addOption('file', 'f', InputOption::VALUE_OPTIONAL, 'File with the initial world configuration');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $gameOfLife = new GameOfLife($this->initialWorld($input));
        $section = $output->section();

        $this->printGameOfLife("\nGeneration Initial", $gameOfLife, $section);
        $numberOfGenerations = (int) $input->getOption('generations');
        for ($currentGeneration = 1; $currentGeneration <= $numberOfGenerations; $currentGeneration++) {
            $this->clock->wait((int) $input->getOption('time_between_generations'));
            $gameOfLife->run();
            $this->printGameOfLife("\nGeneration $currentGeneration", $gameOfLife, $section);
        }

        return 0;
    }

    protected function initialWorld(InputInterface $input): array
    {
        $worldAsString = $input->getArgument('world');
        if ($input->getOption('file')) {
            $worldAsString = trim(str_replace("\n", " ", file_get_contents($input->getOption('file'))));
        }

        return array_map(fn($file) => str_split($file), explode(' ', $worldAsString));
    }

    protected function printGameOfLife(string $header, GameOfLife $gameOfLife, OutputInterface $output): void
    {
        $output->write("\033[H\033[J");
        $output->writeln($header);
        $worldToPrint = '  ' . implode('  ', str_split($gameOfLife->toString()));
        $output->writeln($worldToPrint);
    }
}
