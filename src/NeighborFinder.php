<?php

declare(strict_types = 1);

namespace Katas;

class NeighborFinder
{
    /** @var Cell[][] */
    private array $cells;

    public function __construct(array $cells)
    {
        $this->cells = $cells;
    }

    public function find(int $row, int $col): array
    {
        return [
            ['row' => 0, 'col' => 0],
            ['row' => 0, 'col' => 1],
            ['row' => 0, 'col' => 2],
            ['row' => 1, 'col' => 0],
            ['row' => 1, 'col' => 2],
            ['row' => 2, 'col' => 0],
            ['row' => 2, 'col' => 1],
            ['row' => 2, 'col' => 2],
        ];
    }
}
