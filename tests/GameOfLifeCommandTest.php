<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\GameOfLifeCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;

class GameOfLifeCommandTest extends TestCase
{
    /** @test */
    public function does_not_fail_when_run(): void
    {
        $command = new GameOfLifeCommand();

        $exitNumber = $command->run(new StringInput(''), new NullOutput());

        $this->assertEquals(0, $exitNumber);
    }
}
