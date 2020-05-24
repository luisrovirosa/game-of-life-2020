<?php

namespace Katas\Tests;

use Katas\GameOfLife;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Component\Console\Output\OutputInterface;

class GameOfLifeTest extends TestCase
{
    use ProphecyTrait;

    /** @test */
    public function prints_the_world(): void
    {
        $output = $this->prophesize(OutputInterface::class);
        $gameOfLife = new GameOfLife($output->reveal());

        $gameOfLife->print($output->reveal());

        $output->writeln(Argument::any())->shouldHaveBeenCalled();
    }
}
