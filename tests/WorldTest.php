<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\CellsBuilder;
use Katas\World;
use PHPUnit\Framework\TestCase;

class WorldTest extends TestCase
{
    /**
     * @test
     * @dataProvider noAliveNeighbor
     * @dataProvider oneAliveNeighbor
     * @param array $aliveCells
     */
    public function dies_by_underpopulation_when_is_alive_and_has_less_than_2_neighbors(array $aliveCells): void
    {
        $cells = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();
        $world = new World($cells);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('.', $nextGeneration->at(1, 1));
    }

    /**
     * @test
     * @dataProvider twoAliveNeighbors
     * @param array $aliveCells
     */
    public function survives_when_is_alive_and_has_2_neighbors(array $aliveCells): void
    {
        $cells = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();
        $world = new World($cells);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('*', $nextGeneration->at(1, 1));
    }

    /**
     * @test
     * @dataProvider threeAliveNeighbors
     * @param array $aliveCells
     */
    public function survives_when_is_alive_and_has_3_neighbors(array $aliveCells): void
    {
        $cells = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();
        $world = new World($cells);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('*', $nextGeneration->at(1, 1));
    }

    /**
     * @test
     * @dataProvider moreThanThreeAliveNeighbors
     * @param array $aliveCells
     */
    public function dies_when_is_alive_and_has_more_than_3_neighbors(array $aliveCells): void
    {
        $cells = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();
        $world = new World($cells);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('.', $nextGeneration->at(1, 1));
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

    public function noAliveNeighbor(): array
    {
        return [
            'no neighbors' => [[]],
        ];
    }

    public function oneAliveNeighbor(): array
    {
        return [
            'one neighbor at 0,0' => [[[0, 0]]],
            'one neighbor at 0,1' => [[[0, 1]]],
            'one neighbor at 0,2' => [[[0, 2]]],
            'one neighbor at 1,0' => [[[1, 0]]],
            'one neighbor at 1,2' => [[[1, 2]]],
            'one neighbor at 2,0' => [[[2, 0]]],
            'one neighbor at 2,1' => [[[2, 1]]],
            'one neighbor at 2,2' => [[[2, 2]]],
        ];
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

    protected function builderWithCellsAlive(array $neighbors): CellsBuilder
    {
        $cellsBuilder = new CellsBuilder();
        array_map(fn(array $neighbor) => $cellsBuilder->aliveAt($neighbor[0], $neighbor[1]), $neighbors);

        return $cellsBuilder;
    }
}
