<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\Clock;
use PHPUnit\Framework\TestCase;

class ClockTest extends TestCase
{
    /** @test */
    public function waits_the_expected_time(): void
    {
        $clock = new Clock();
        $initialTime = microtime(true) * 1000;

        $clock->wait(100);

        $finalTime = microtime(true) * 1000;
        $this->assertEqualsWithDelta(100, $finalTime - $initialTime, 10);
    }
}
