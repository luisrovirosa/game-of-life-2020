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
    public function find_the_number_of_alive_neighbors(int $row, int $col, array $aliveNeighbors, $expectedNeighbors): void
    {
        $cells = (new CellsBuilder())->withAliveCells($aliveNeighbors)->build();
        $finder = new NeighborFinder($cells);

        $numberOfAliveNeighbors = $finder->numberOfAliveNeighbors($row, $col);

        $this->assertEquals($expectedNeighbors, $numberOfAliveNeighbors);
    }

    public function scenarios(): array
    {
        return [
            'at position 1,1 without neighbors' => [1, 1, [], 0],
            'at position 1,1 with one neighbor' => [1, 1, [[0, 0]], 1],
        ];
    }
}
