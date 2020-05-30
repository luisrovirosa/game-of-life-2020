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
            'at center without neighbors does not find any neighbor' => [1, 1, [], 0],
            'at center with one neighbor detects the neighbor' => [1, 1, [[0, 0]], 1],
            'at position 0,0 with one neighbor detects the neighbor' => [0, 0, [[1, 1]], 1],
        ];
    }
}
