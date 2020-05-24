<?php

namespace Katas\Tests;

use Katas\GameOfLife;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Output\NullOutput;

class GameOfLifeTest extends TestCase
{
    /** @test */
    public function please_rename_me_or_delete_me(): void
    {
        $myObject = new GameOfLife(new NullOutput());
        $this->assertTrue($myObject->giveMeAProperName());
    }
}
