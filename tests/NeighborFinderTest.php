<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\NeighborFinder;
use PHPUnit\Framework\TestCase;

class NeighborFinderTest extends TestCase
{
    /**
     * @test
     * @dataProvider scenariosOf3x3
     * @param int $row
     * @param int $col
     * @param int $expectedNumberOfNeighbors
     */
    public function find_the_number_of_alive_neighbors_in_3x3(int $row, int $col, int $expectedNumberOfNeighbors): void
    {
        $finder = new NeighborFinder(3, 3);

        $numberOfAliveNeighbors = $finder->find($row, $col);

        $this->assertCount($expectedNumberOfNeighbors, $numberOfAliveNeighbors);
    }

    /**
     * @test
     * @dataProvider scenariosOf5x5
     * @param int $row
     * @param int $col
     * @param int $expectedNumberOfNeighbors
     */
    public function find_the_number_of_alive_neighbors_in_5x5(int $row, int $col, int $expectedNumberOfNeighbors): void
    {
        $finder = new NeighborFinder(5, 5);

        $numberOfAliveNeighbors = $finder->find($row, $col);

        $this->assertCount($expectedNumberOfNeighbors, $numberOfAliveNeighbors);
    }

    public function scenariosOf3x3(): array
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

    public function scenariosOf5x5(): array
    {
        return [
            'at position 0,0' => [0, 0, 3],
            'at position 0,1' => [0, 1, 5],
            'at position 0,2' => [0, 2, 5],
            'at position 1,0' => [1, 0, 5],
            'at position 1,1' => [1, 1, 8],
            'at position 1,2' => [1, 2, 8],
            'at position 2,0' => [2, 0, 5],
            'at position 2,1' => [2, 1, 8],
            'at position 2,2' => [2, 2, 8],
            'at position 4,4' => [4, 4, 3],
        ];
    }
}
