<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\Clock;
use PHPUnit\Framework\TestCase;

class ClockTest extends TestCase
{
    /**
     * @test
     * @dataProvider positiveMilliseconds
     */
    public function waits_the_expected_time($milisecondsToWait): void
    {
        $clock = new Clock();
        $initialTime = microtime(true) * 1000;

        $clock->wait($milisecondsToWait);

        $finalTime = microtime(true) * 1000;
        $this->assertEqualsWithDelta($milisecondsToWait, $finalTime - $initialTime, 10);
    }

    public function positiveMilliseconds(): array
    {
        return [
            [100],
        ];
    }
}
