<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\CellsBuilder;
use Katas\World;
use PHPUnit\Framework\TestCase;

class WorldTest extends TestCase
{
    /** @test */
    public function dies_when_no_neighbors(): void
    {
        $world = new World($this->cellsWithNeighborsAlive([]));

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('.', $nextGeneration->at(1, 1));
    }

    /**
     * @test
     * @dataProvider oneAliveNeighbor
     * @param array $cells
     */
    public function dies_when_one_neighbors(array $cells): void
    {
        $world = new World($this->cellsWithNeighborsAlive($cells));

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('.', $nextGeneration->at(1, 1));
    }

    public function oneAliveNeighbor(): array
    {
        return [
            [[[0, 0]]],
            [[[0, 1]]],
            [[[0, 2]]],
            [[[1, 0]]],
            [[[1, 2]]],
            [[[2, 0]]],
            [[[2, 1]]],
            [[[2, 2]]],
        ];
    }

    /**
     * @test
     * @dataProvider twoAliveNeighbors
     * @param array $cells
     */
    public function survives_when_2_neighbors(array $cells): void
    {
        $world = new World($this->cellsWithNeighborsAlive($cells));

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('*', $nextGeneration->at(1, 1));
    }

    public function twoAliveNeighbors(): array
    {
        return [
            [[[0, 0], [0, 1]]],
            [[[0, 1], [0, 2]]],
            [[[0, 0], [0, 2]]],
            [[[1, 0], [1, 2]]],
            [[[2, 0], [2, 1]]],
            [[[2, 0], [2, 2]]],
        ];
    }

    /**
     * @test
     * @dataProvider threeAliveNeighbors
     * @param array $cells
     */
    public function survives_when_3_neighbors(array $cells): void
    {
        $world = new World($this->cellsWithNeighborsAlive($cells));

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('*', $nextGeneration->at(1, 1));
    }

    public function threeAliveNeighbors(): array
    {
        return [
            [[[0, 0], [0, 1], [0, 2]]],
            [[[0, 1], [0, 2], [1, 0]]],
            [[[0, 0], [0, 2], [1, 2]]],
            [[[1, 0], [1, 2], [0, 0]]],
            [[[2, 0], [2, 1], [1, 1]]],
            [[[2, 0], [2, 1], [2, 2]]],
        ];
    }

    protected function cellsWithNeighborsAlive(array $neighbors): array
    {
        $cellsBuilder = (new CellsBuilder())->aliveAt(1, 1);
        array_map(fn(array $neighbor) => $cellsBuilder->aliveAt($neighbor[0], $neighbor[1]), $neighbors);

        return $cellsBuilder->build();
    }
}
