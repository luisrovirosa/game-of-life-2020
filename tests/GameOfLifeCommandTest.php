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
    private const ONE_SECOND_IN_MILLISECONDS = 1000;
    private const INITIAL_WORLD = 1;
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
    public function prints_initial_world(): void
    {
        $this->command->execute(['--generations' => 0]);

        $this->assertPrintsOnlyInitialWorld();
    }

    /** @test */
    public function initial_world_can_be_defined(): void
    {
        $this->command->execute(['world' => '*** *** ***']);

        $this->assertStringContainsString("***\n***\n***", $this->output());
    }

    /** @test */
    public function a_number_of_generations_can_be_specified(): void
    {
        $numberOfGenerations = 10;
        
        $this->command->execute(['--generations' => $numberOfGenerations]);

        $this->assertPrintsGenerations($numberOfGenerations);
    }

    /** @test */
    public function waits_1_second_after_every_generation(): void
    {
        $numberOfGenerations = 2;

        $this->command->execute(['--generations' => $numberOfGenerations]);

        $this->clock->wait(self::ONE_SECOND_IN_MILLISECONDS)->shouldHaveBeenCalledTimes($numberOfGenerations);
    }

    /** @test */
    public function the_time_between_generations_can_be_defined(): void
    {
        $timeBetweenGenerations = 0;

        $this->command->execute(['--time_between_generations' => $timeBetweenGenerations]);

        $this->clock->wait($timeBetweenGenerations)->shouldHaveBeenCalled();
    }

    private function assertPrintsOnlyInitialWorld(): void
    {
        $this->assertPrintsGenerations(0);
    }

    private function assertPrintsGenerations(int $numberOfGenerations): void
    {
        $this->assertCount(self::LINES_PER_ITERATION * ($numberOfGenerations + self::INITIAL_WORLD) + self::EXTRA_LINE, explode("\n", $this->output()));
    }

    private function output(): string
    {
        return $this->command->getDisplay();
    }
}
