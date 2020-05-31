<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\NeighborFinder;
use PHPUnit\Framework\TestCase;

class NeighborFinderTest extends TestCase
{
    /**
     * @test
     * @dataProvider scenarios
     * @param int $row
     * @param int $col
     * @param int $expectedNeighbors
     */
    public function find_the_number_of_alive_neighbors(int $row, int $col, int $expectedNumberOfNeighbors): void
    {
        $finder = new NeighborFinder(3, 3);

        $numberOfAliveNeighbors = $finder->find($row, $col);

        $this->assertCount($expectedNumberOfNeighbors, $numberOfAliveNeighbors);
    }

    public function scenarios(): array
    {
        return [
            'at position 0,0' => [0, 0, 3],
            'at position 0,1' => [0, 1, 5],
            'at position 0,2' => [0, 2, 3],
            'at position 1,0' => [1, 0, 5],
            'at position 1,1' => [1, 1, 8],
            'at position 1,2' => [1, 2, 5],
            'at position 2,0' => [2, 0, 3],
            'at position 2,1' => [2, 1, 5],
            'at position 2,2' => [2, 2, 3],
        ];
    }
}
