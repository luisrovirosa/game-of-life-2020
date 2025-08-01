<?php

declare(strict_types=1);

namespace Katas\Tests;

use Katas\Clock;
use Katas\GameOfLifeCommand;
use PHPUnit\Framework\Attributes\Test;
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

    #[Test]
    public function does_not_fail_when_run(): void
    {
        $exitNumber = $this->executeCommand([]);

        $this->assertEquals(0, $exitNumber);
    }

    #[Test]
    public function prints_initial_world(): void
    {
        $this->executeCommand(['--generations' => 0]);

        $this->assertPrintsOnlyInitialWorld();
    }

    #[Test]
    public function initial_world_can_be_defined(): void
    {
        $this->executeCommand(['world' => '*** *** ***']);

        $this->assertStringContainsString("  *  *  *  \n  *  *  *  \n  *  *  *", $this->getOutput());
    }

    #[Test]
    public function a_number_of_generations_can_be_specified(): void
    {
        $numberOfGenerations = 10;

        $this->executeCommand(['--generations' => $numberOfGenerations]);

        $this->assertPrintsGenerations($numberOfGenerations);
    }

    #[Test]
    public function waits_1_second_after_every_generation(): void
    {
        $numberOfGenerations = 2;

        $this->executeCommand(['--generations' => $numberOfGenerations]);

        $this->clock->wait(self::ONE_SECOND_IN_MILLISECONDS)->shouldHaveBeenCalledTimes($numberOfGenerations);
    }

    #[Test]
    public function the_time_between_generations_can_be_defined(): void
    {
        $timeBetweenGenerations = 0;

        $this->executeCommand(['--time_between_generations' => $timeBetweenGenerations]);

        $this->clock->wait($timeBetweenGenerations)->shouldHaveBeenCalled();
    }

    #[Test]
    public function load_initial_world_from_a_file(): void
    {
        $this->executeCommand(['--file' => 'data/blinker_3x3.txt']);

        $this->assertStringContainsString("  .  *  .  \n  .  *  .  \n  .  *  .", $this->getOutput());
    }

    private function assertPrintsOnlyInitialWorld(): void
    {
        $this->assertPrintsGenerations(0);
    }

    private function assertPrintsGenerations(int $numberOfGenerations): void
    {
        $this->assertCount(self::LINES_PER_ITERATION * ($numberOfGenerations + self::INITIAL_WORLD) + self::EXTRA_LINE, explode("\n", $this->getOutput()), "Output:->{$this->getOutput()}<-");
    }

    private function getOutput(): string
    {
        return $this->command->getDisplay();
    }

    private function executeCommand(array $input): int
    {
        return $this->command->execute($input, ['capture_stderr_separately' => true]);
    }
}
