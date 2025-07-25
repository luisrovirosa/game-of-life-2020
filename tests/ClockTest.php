<?php

declare(strict_types=1);

namespace Katas\Tests;

use Katas\Clock;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ClockTest extends TestCase
{
    #[Test]
    #[DataProvider('positiveMilliseconds')]
    public function waits_the_expected_time(int $millisecondsToWait): void
    {
        $clock = new Clock();
        $initialTime = microtime(true) * 1000;

        $clock->wait($millisecondsToWait);

        $finalTime = microtime(true) * 1000;
        $this->assertEqualsWithDelta($millisecondsToWait, $finalTime - $initialTime, 1);
    }

    public static function positiveMilliseconds(): array
    {
        return [
            'Very small amount' => [1],
            'Small amount' => [10],
        ];
    }
}
