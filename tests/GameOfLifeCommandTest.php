<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\Clock;
use Katas\GameOfLifeCommand;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Component\Console\Tester\CommandTester;

class GameOfLifeCommandTest extends TestCase
{
    use ProphecyTrait;

    private const EXTRA_LINE = 1;
    private const WORLD_SIZE = 3;
    private const HEADER_PER_GENERATION = 2;
    private const LINES_PER_ITERATION = self::WORLD_SIZE + self::HEADER_PER_GENERATION;
    const ONE_SECOND_IN_MILISECONDS = 1000;
    private CommandTester $command;
    private $clock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->clock = $this->prophesize(Clock::class);
        $gameOfLife = new GameOfLifeCommand($this->clock->reveal());
        $this->command = new CommandTester($gameOfLife);
    }

    /** @test */
    public function does_not_fail_when_run(): void
    {
        $exitNumber = $this->command->execute([]);

        $this->assertEquals(0, $exitNumber);
    }

    /** @test */
    public function a_number_of_generations_can_be_specified(): void
    {
        $this->command->execute(['--generations' => 10]);

        $output = $this->command->getDisplay(true);
        $this->assertCount(self::LINES_PER_ITERATION * 10 + self::EXTRA_LINE, explode("\n", $output));
    }

    /** @test */
    public function waits_1_second_after_every_generation(): void
    {
        $numberOfGenerations = 2;
        
        $this->command->execute(['--generations' => $numberOfGenerations]);

        $this->clock->wait(self::ONE_SECOND_IN_MILISECONDS)->shouldHaveBeenCalledTimes($numberOfGenerations);
    }
}
