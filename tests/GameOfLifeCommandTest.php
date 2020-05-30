<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\GameOfLifeCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class GameOfLifeCommandTest extends TestCase
{
    /** @test */
    public function does_not_fail_when_run(): void
    {
        $command = new CommandTester(new GameOfLifeCommand());

        $exitNumber = $command->execute([]);

        $this->assertEquals(0, $exitNumber);
    }
}
