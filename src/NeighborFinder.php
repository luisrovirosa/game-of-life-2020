<?php

declare(strict_types = 1);

namespace Katas;

class NeighborFinder
{
    public function find(int $row, int $col): array
    {
        $neighbors = [];
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if ($this->areNeighbors($row, $col, $i, $j)) {
                    $neighbors[] = ['row' => $i, 'col' => $j];
                }
            }
        }

        return $neighbors;
    }

    private function areNeighbors(int $row, int $col, int $rowNeighbor, int $colNeighbor): bool
    {
        return !($rowNeighbor === $row && $colNeighbor === $col);
    }
}
