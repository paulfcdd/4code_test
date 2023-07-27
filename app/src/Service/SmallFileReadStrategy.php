<?php

declare(strict_types=1);

namespace App\Service;

use App\Interface\FileReadStrategyInterface;

class SmallFileReadStrategy implements FileReadStrategyInterface
{
    public function getLines(string $filePath): \Generator {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            yield $line;
        }
    }
}
