<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\CellsBuilder;
use Katas\NeighborFinder;
use PHPUnit\Framework\TestCase;

class NeighborFinderTest extends TestCase
{
    /**
     * @test
     * @dataProvider scenarios
     * @param int $row
     * @param int $col
     * @param array $aliveNeighbors
     * @param $expectedNeighbors
     */
    public function find_the_number_of_alive_neighbors(int $row, int $col, $expectedNumberOfNeighbors): void
    {
        $cells = (new CellsBuilder())->build();
        $finder = new NeighborFinder($cells);

        $numberOfAliveNeighbors = $finder->find($row, $col);

        $this->assertCount($expectedNumberOfNeighbors, $numberOfAliveNeighbors);
    }

    public function scenarios(): array
    {
        return [
            'at center' => [1, 1, 8],
        ];
    }
}
