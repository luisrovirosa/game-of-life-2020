<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\CellsBuilder;
use Katas\NeighborFinder;
use PHPUnit\Framework\TestCase;

class NeighborFinderTest extends TestCase
{
    /** @test */
    public function find_the_number_of_alive_neighbors(): void
    {
        $cells = (new CellsBuilder())->build();
        $finder = new NeighborFinder($cells);

        $numberOfAliveNeighbors = $finder->numberOfAliveNeighbors(1, 1);

        $this->assertEquals(0, $numberOfAliveNeighbors);
    }
}
