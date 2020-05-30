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
        if ($this->isThemselves($rowNeighbor, $row, $colNeighbor, $col)) {
            return false;
        }
        if ($rowNeighbor - $row > 1) {
            return false;
        }

        return true;
    }

    private function isThemselves(int $rowNeighbor, int $row, int $colNeighbor, int $col): bool
    {
        return ($rowNeighbor === $row && $colNeighbor === $col);
    }
}
