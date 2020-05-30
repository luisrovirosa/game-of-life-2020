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

    public function numberOfAliveNeighbors(int $row, int $col): int
    {
        $isAliveFilter = fn($neighborPosition): bool => $this->cells[$neighborPosition['row']][$neighborPosition['col']]->isAlive();

        return count(array_filter($this->find($row, $col), $isAliveFilter));
    }

    private function find(int $row, int $col): array
    {
        $neighbors = [];
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if ($i !== $row || $j !== $col) {
                    $neighbors[] = ['row' => $i, 'col' => $j];
                }
            }
        }

        return $neighbors;
    }
}
