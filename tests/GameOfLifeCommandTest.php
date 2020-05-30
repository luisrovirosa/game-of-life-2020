<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\GameOfLifeCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class GameOfLifeCommandTest extends TestCase
{
    const EXTRA_LINE = 1;

    /** @test */
    public function does_not_fail_when_run(): void
    {
        $command = new CommandTester(new GameOfLifeCommand());

        $exitNumber = $command->execute([]);

        $this->assertEquals(0, $exitNumber);
    }

    /** @test */
    public function a_number_of_generations_can_be_specified(): void
    {
        $command = new CommandTester(new GameOfLifeCommand());

        $command->execute(['--generations' => 10]);

        $output = $command->getDisplay(true);
        $this->assertCount(3 * 10 + self::EXTRA_LINE, explode("\n", $output));
    }
}
