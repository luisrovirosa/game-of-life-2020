<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\World;
use PHPUnit\Framework\TestCase;

class WorldTest extends TestCase
{
    /** @test */
    public function dies_when_underpopulation(): void
    {
        $world = new World([
            ['.', '.', '.'],
            ['.', '*', '.'],
            ['.', '.', '.'],
        ]);

        $nextGeneration = $world->nextGeneration();

        $expectedWorld = new World([
            ['.', '.', '.'],
            ['.', '.', '.'],
            ['.', '.', '.'],
        ]);
        $this->assertEquals($expectedWorld, $nextGeneration);
    }
}