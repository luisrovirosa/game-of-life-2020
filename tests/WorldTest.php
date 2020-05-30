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
        $cells = $this->builderWithCellsAlive([])->aliveAt(1, 1)->build();
        $world = new World($cells);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('.', $nextGeneration->at(1, 1));
    }

    /**
     * @test
     * @dataProvider oneAliveNeighbor
     * @param array $aliveCells
     */
    public function dies_when_one_neighbors(array $aliveCells): void
    {
        $cells = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();
        $world = new World($cells);

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
     * @param array $aliveCells
     */
    public function survives_when_2_neighbors(array $aliveCells): void
    {
        $cells = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();
        $world = new World($cells);

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
     * @param array $aliveCells
     */
    public function survives_when_3_neighbors(array $aliveCells): void
    {
        $cells = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();
        $world = new World($cells);

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
            [[[2, 0], [2, 1], [1, 0]]],
            [[[2, 0], [2, 1], [2, 2]]],
        ];
    }

    /**
     * @test
     * @dataProvider moreThanThreeAliveNeighbors
     * @param array $aliveCells
     */
    public function dies_when_more_than_3_neighbors(array $aliveCells): void
    {
        $cells = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();
        $world = new World($cells);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('.', $nextGeneration->at(1, 1));
    }

    public function moreThanThreeAliveNeighbors(): array
    {
        return [
            [[[0, 0], [0, 1], [0, 2], [1, 2]]],
            [[[0, 0], [0, 2], [1, 2], [2, 2]]],
            [[[0, 0], [1, 0], [1, 2], [2, 2]]],
            [[[0, 1], [0, 2], [1, 0], [1, 2]]],
            [[[0, 1], [1, 0], [2, 0], [2, 1]]],
            [[[0, 2], [2, 0], [2, 1], [2, 2]]],
            [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2]]],
            [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2], [2, 0]]],
            [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2], [2, 0], [2, 1]]],
            [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2], [2, 0], [2, 1], [2, 2]]],
        ];
    }

    /**
     * @test
     * @dataProvider lessOrMoreThan3Neighbors
     * @param array $aliveCells
     */
    public function remains_dead_when_less_or_more_than_3_neighbors(array $aliveCells): void
    {
        $cells = $this->builderWithCellsAlive($aliveCells)->build();
        $world = new World($cells);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('.', $nextGeneration->at(1, 1));
    }

    public function lessOrMoreThan3Neighbors(): array
    {
        return [
            [[[0, 0]]],
            [[[0, 2]]],
            [[[0, 0], [1, 0]]],
            [[[1, 0], [1, 2]]],
            [[[2, 0], [2, 2]]],
            [[[0, 1], [0, 2], [1, 0], [1, 2]]],
            [[[0, 1], [1, 0], [2, 0], [2, 1]]],
            [[[0, 2], [2, 0], [2, 1], [2, 2]]],
            [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2]]],
            [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2], [2, 0]]],
            [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2], [2, 0], [2, 1]]],
            [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2], [2, 0], [2, 1], [2, 2]]],
        ];
    }

    /**
     * @test
     * @dataProvider threeAliveNeighbors
     * @param array $aliveCells
     */
    public function reproduces_when_is_dead_and_has_3_neighbors(array $aliveCells): void
    {
        $cells = $this->builderWithCellsAlive($aliveCells)->build();
        $world = new World($cells);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('*', $nextGeneration->at(1, 1));
    }

    protected function builderWithCellsAlive(array $neighbors): CellsBuilder
    {
        $cellsBuilder = new CellsBuilder();
        array_map(fn(array $neighbor) => $cellsBuilder->aliveAt($neighbor[0], $neighbor[1]), $neighbors);

        return $cellsBuilder;
    }
}
