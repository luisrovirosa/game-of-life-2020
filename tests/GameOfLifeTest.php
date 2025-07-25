<?php

namespace Katas\Tests;

use Katas\GameOfLife;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GameOfLifeTest extends TestCase
{
    #[Test]
    public function mutates_the_world(): void
    {
        $world = [
            ['.', '.', '.'],
            ['.', '*', '.'],
            ['.', '.', '.'],
        ];
        $gameOfLife = new GameOfLife($world);

        $gameOfLife->run();

        $this->assertEquals("...\n...\n...", $gameOfLife->toString());
    }

    #[Test]
    public function mutates_a_5x5_world(): void
    {
        $world = [
            ['.', '.', '.', '.', '.'],
            ['.', '.', '*', '.', '.'],
            ['.', '.', '*', '.', '.'],
            ['.', '.', '*', '.', '.'],
            ['.', '.', '.', '.', '.'],
        ];
        $gameOfLife = new GameOfLife($world);

        $gameOfLife->run();

        $this->assertEquals(".....\n.....\n.***.\n.....\n.....", $gameOfLife->toString());
    }
}
