<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\WorldBuilder;
use PHPUnit\Framework\TestCase;

class WorldTest extends TestCase
{
    /** @test */
    public function worlds_that_does_not_change(): void
    {
        $world = (new WorldBuilder(3, 3))->withAliveCells([[0, 0], [0, 1], [1, 0], [1, 1]])->build();

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals("**.\n**.\n...", $nextGeneration->toString());
    }

    /** @test */
    public function world_blinker(): void
    {
        $this->markTestIncomplete("Not yet");
        $world = (new WorldBuilder(5, 5))->withAliveCells([[2, 1], [2, 2], [2, 2]])->build();

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals(".....\n..*..\n..*..\n..*..\n.....\n", $nextGeneration->toString());
    }

    /**
     * @test
     * @dataProvider noAliveNeighbor
     * @dataProvider oneAliveNeighbor
     * @param array $aliveCells
     */
    public function dies_by_underpopulation_when_is_alive_and_has_less_than_2_neighbors(array $aliveCells): void
    {
        $world = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();

        $nextGeneration = $world->nextGeneration();

        $this->assertFalse($nextGeneration->isAlive(1, 1));
    }

    /**
     * @test
     * @dataProvider twoAliveNeighbors
     * @param array $aliveCells
     */
    public function survives_when_is_alive_and_has_2_neighbors(array $aliveCells): void
    {
        $world = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();

        $nextGeneration = $world->nextGeneration();

        $this->assertTrue($nextGeneration->isAlive(1, 1));
    }

    /**
     * @test
     * @dataProvider threeAliveNeighbors
     * @param array $aliveCells
     */
    public function survives_when_is_alive_and_has_3_neighbors(array $aliveCells): void
    {
        $world = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();

        $nextGeneration = $world->nextGeneration();

        $this->assertTrue($nextGeneration->isAlive(1, 1));
    }

    /**
     * @test
     * @dataProvider moreThanThreeAliveNeighbors
     * @param array $aliveCells
     */
    public function dies_when_is_alive_and_has_more_than_3_neighbors(array $aliveCells): void
    {
        $world = $this->builderWithCellsAlive($aliveCells)->aliveAt(1, 1)->build();

        $nextGeneration = $world->nextGeneration();

        $this->assertFalse($nextGeneration->isAlive(1, 1));
    }

    /**
     * @test
     * @dataProvider noAliveNeighbor
     * @dataProvider oneAliveNeighbor
     * @dataProvider twoAliveNeighbors
     * @dataProvider moreThanThreeAliveNeighbors
     * @param array $aliveCells
     */
    public function remains_dead_when_less_or_more_than_3_neighbors(array $aliveCells): void
    {
        $world = $this->builderWithCellsAlive($aliveCells)->build();

        $nextGeneration = $world->nextGeneration();

        $this->assertFalse($nextGeneration->isAlive(1, 1));
    }

    /**
     * @test
     * @dataProvider threeAliveNeighbors
     * @param array $aliveCells
     */
    public function reproduces_when_is_dead_and_has_3_neighbors(array $aliveCells): void
    {
        $world = $this->builderWithCellsAlive($aliveCells)->build();

        $nextGeneration = $world->nextGeneration();

        $this->assertTrue($nextGeneration->isAlive(1, 1));
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
            'two neighbor at 0,0 and 0,1' => [[[0, 0], [0, 1]]],
            'two neighbor at 0,1 and 0,2' => [[[0, 1], [0, 2]]],
            'two neighbor at 0,0 and 0,2' => [[[0, 0], [0, 2]]],
            'two neighbor at 1,0 and 1,2' => [[[1, 0], [1, 2]]],
            'two neighbor at 2,0 and 2,1' => [[[2, 0], [2, 1]]],
            'two neighbor at 2,0 and 2,2' => [[[2, 0], [2, 2]]],
        ];
    }

    public function threeAliveNeighbors(): array
    {
        return [
            'three neighbor at 0,0 and 0,1 and 0,2' => [[[0, 0], [0, 1], [0, 2]]],
            'three neighbor at 0,1 and 0,2 and 1,0' => [[[0, 1], [0, 2], [1, 0]]],
            'three neighbor at 0,0 and 0,2 and 1,2' => [[[0, 0], [0, 2], [1, 2]]],
            'three neighbor at 1,0 and 1,2 and 0,0' => [[[1, 0], [1, 2], [0, 0]]],
            'three neighbor at 2,0 and 2,1 and 1,0' => [[[2, 0], [2, 1], [1, 0]]],
            'three neighbor at 2,0 and 2,1 and 2,2' => [[[2, 0], [2, 1], [2, 2]]],
        ];
    }

    public function moreThanThreeAliveNeighbors(): array
    {
        return [
            'four neighbor at 0,0 and 0,1 and 0,2 and 1,2' => [[[0, 0], [0, 1], [0, 2], [1, 2]]],
            'four neighbor at 0,0 and 0,2 and 1,2 and 2,2' => [[[0, 0], [0, 2], [1, 2], [2, 2]]],
            'four neighbor at 0,0 and 1,0 and 1,2 and 2,2' => [[[0, 0], [1, 0], [1, 2], [2, 2]]],
            'four neighbor at 0,1 and 0,2 and 1,0 and 1,2' => [[[0, 1], [0, 2], [1, 0], [1, 2]]],
            'four neighbor at 0,1 and 1,0 and 2,0 and 2,1' => [[[0, 1], [1, 0], [2, 0], [2, 1]]],
            'four neighbor at 0,2 and 2,0 and 2,1 and 2,2' => [[[0, 2], [2, 0], [2, 1], [2, 2]]],
            'five neighbor at 0,0 and 0,1 and 0,2 and 1,0 and 1,2' => [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2]]],
            'six neighbor at all except 2,1 and 2,2' => [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2], [2, 0]]],
            'seven neighbor at all except 2,2' => [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2], [2, 0], [2, 1]]],
            'eight neighbor' => [[[0, 0], [0, 1], [0, 2], [1, 0], [1, 2], [2, 0], [2, 1], [2, 2]]],
        ];
    }

    protected function builderWithCellsAlive(array $neighbors): WorldBuilder
    {
        return (new WorldBuilder(3, 3))->withAliveCells($neighbors);
    }
}
