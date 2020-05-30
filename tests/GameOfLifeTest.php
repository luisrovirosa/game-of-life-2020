<?php

namespace Katas\Tests;

use Katas\GameOfLife;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Component\Console\Output\OutputInterface;

class GameOfLifeTest extends TestCase
{
    use ProphecyTrait;

    /** @test */
    public function prints_the_world(): void
    {
        $output = $this->prophesize(OutputInterface::class);
        $world = [
            ['*', '.', '.'],
            ['.', '*', '.'],
            ['.', '.', '*'],
        ];
        $gameOfLife = new GameOfLife($world);

        $gameOfLife->print($output->reveal());

        $output->write("*..\n.*.\n..*\n")->shouldHaveBeenCalledOnce();
    }

    /** @test */
    public function mutates_the_world(): void
    {
        $output = $this->prophesize(OutputInterface::class);
        $world = [
            ['.', '.', '.'],
            ['.', '*', '.'],
            ['.', '.', '.'],
        ];
        $gameOfLife = new GameOfLife($world);

        $gameOfLife->run();

        $gameOfLife->print($output->reveal());
        $output->write("...\n...\n...\n")->shouldHaveBeenCalledOnce();
    }
}
