<?php

declare(strict_types=1);

namespace App\Controller;

use App\Interface\FileReadStrategyInterface;

class LargeFileReadStrategy implements FileReadStrategyInterface
{
    public function getLines(string $filePath): \Generator {
        $file = new \SplFileObject($filePath, 'r');
        while (!$file->eof()) {
            $line = $file->fgets();
            if ($line) {
                yield $line;
            }
        }
    }
}
