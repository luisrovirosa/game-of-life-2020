<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\GameOfLifeCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class GameOfLifeCommandTest extends TestCase
{
    private const EXTRA_LINE = 1;
    private const WORLD_SIZE = 3;
    private const HEADER_PER_GENERATION = 2;
    private const LINES_PER_ITERATION = self::WORLD_SIZE + self::HEADER_PER_GENERATION;

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
        $this->assertCount(self::LINES_PER_ITERATION * 10 + self::EXTRA_LINE, explode("\n", $output));
    }
}
