<?php

namespace Katas\Tests;

use Katas\GameOfLife;
use PHPUnit\Framework\TestCase;

class GameOfLifeTest extends TestCase
{
    /** @test */
    public function mutates_the_world(): void
    {
        $world = [
            ['.', '.', '.'],
            ['.', '*', '.'],
            ['.', '.', '.'],
        ];
        $gameOfLife = new GameOfLife($world);

        $gameOfLife->run();

        $this->assertEquals("...\n...\n...\n", $gameOfLife->toString());
    }
}
