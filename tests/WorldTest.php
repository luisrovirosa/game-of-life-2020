<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\World;
use PHPUnit\Framework\TestCase;

class WorldTest extends TestCase
{
    /** @test */
    public function dies_when_no_neighbors(): void
    {
        $world = new World([
            ['.', '.', '.'],
            ['.', '*', '.'],
            ['.', '.', '.'],
        ]);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('.', $nextGeneration->at(1, 1));
    }

    /** @test */
    public function survives_when_2_neighbors(): void
    {
        $world = new World([
            ['*', '*', '.'],
            ['.', '*', '.'],
            ['.', '.', '.'],
        ]);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('*', $nextGeneration->at(1, 1));
    }
}
