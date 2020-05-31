<?php

declare(strict_types = 1);

namespace Katas;

class NeighborFinder
{
    private int $numberOfRows;
    private int $numberOfCols;

    public function __construct()
    {
        $this->numberOfRows = 3;
        $this->numberOfCols = 3;
    }

    public function find(int $row, int $col): array
    {
        $neighbors = [];
        for ($i = 0; $i < $this->numberOfRows; $i++) {
            for ($j = 0; $j < $this->numberOfCols; $j++) {
                if ($this->areNeighbors($row, $col, $i, $j)) {
                    $neighbors[] = ['row' => $i, 'col' => $j];
                }
            }
        }

        return $neighbors;
    }

    private function areNeighbors(int $row, int $col, int $rowNeighbor, int $colNeighbor): bool
    {
        if ($this->isThemselves($row, $col, $rowNeighbor, $colNeighbor)) {
            return false;
        }
        if ($rowNeighbor - $row > 1) {
            return false;
        }
        if ($rowNeighbor - $row < -1) {
            return false;
        }
        if ($colNeighbor - $col > 1) {
            return false;
        }
        if ($colNeighbor - $col < -1) {
            return false;
        }

        return true;
    }

    private function isThemselves(int $row, int $col, int $rowNeighbor, int $colNeighbor): bool
    {
        return ($rowNeighbor === $row && $colNeighbor === $col);
    }
}
