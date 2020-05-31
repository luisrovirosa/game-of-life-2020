<?php

namespace Katas;

class GameOfLife
{
    private World $world;

    public function __construct(array $world)
    {
        $this->world = (new WorldBuilder(3, 3))->withCells($world)->build();
    }

    public function run(): void
    {
        $this->world = $this->world->nextGeneration();
    }

    public function toString(): string
    {
        return $this->world->toString();
    }
}
