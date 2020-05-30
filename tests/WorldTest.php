<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\World;
use PHPUnit\Framework\TestCase;

class WorldTest extends TestCase
{
    /** @test */
    public function dies_when_no_neighbors(): void
    {
        $world = new World($this->cellsBuilder()->build());

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('.', $nextGeneration->at(1, 1));
    }

    /**
     * @test
     * @dataProvider oneNeighbor
     * @param array $cells
     */
    public function dies_when_one_neighbors(array $cells): void
    {
        $world = new World($cells);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('.', $nextGeneration->at(1, 1));
    }

    public function oneNeighbor(): array
    {
        return [
            [$this->cellsBuilder()->aliveAt(0, 0)->build()],
            [$this->cellsBuilder()->aliveAt(0, 1)->build()],
            [$this->cellsBuilder()->aliveAt(0, 2)->build()],
            [$this->cellsBuilder()->aliveAt(1, 0)->build()],
            [$this->cellsBuilder()->aliveAt(1, 2)->build()],
            [$this->cellsBuilder()->aliveAt(2, 0)->build()],
            [$this->cellsBuilder()->aliveAt(2, 1)->build()],
            [$this->cellsBuilder()->aliveAt(2, 2)->build()],
        ];
    }

    /**
     * @test
     * @dataProvider twoNeighbors
     * @param array $cells
     */
    public function survives_when_2_neighbors(array $cells): void
    {
        $world = new World($cells);

        $nextGeneration = $world->nextGeneration();

        $this->assertEquals('*', $nextGeneration->at(1, 1));
    }

    public function twoNeighbors(): array
    {
        return [
            [$this->cellsBuilder()->aliveAt(0, 0)->aliveAt(0, 1)->build()],
            [$this->cellsBuilder()->aliveAt(0, 1)->aliveAt(0, 2)->build()],
            [$this->cellsBuilder()->aliveAt(0, 0)->aliveAt(0, 2)->build()],
            [$this->cellsBuilder()->aliveAt(1, 0)->aliveAt(1, 2)->build()],
            [$this->cellsBuilder()->aliveAt(2, 0)->aliveAt(2, 1)->build()],
            [$this->cellsBuilder()->aliveAt(2, 0)->aliveAt(2, 2)->build()],
        ];
    }

    protected function cellsBuilder(): CellsBuilder
    {
        return new CellsBuilder();
    }
}
