<?php

declare(strict_types=1);

namespace App\Service;

use App\Interface\LineReaderInterface;

class LineByLineFileReader implements LineReaderInterface
{
    public \SplFileObject $file;
    private string $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;

        if (!file_exists($this->filePath)) {
            throw new \InvalidArgumentException("File not found: $this->filePath");
        }
    }

    public function loadFile(): void {
        $this->file = new \SplFileObject($this->filePath, 'r');
    }

    public function getLines(): \Generator {
        while (!$this->file->eof()) {
            $line = $this->file->fgets();
            if ($line) {
                yield $line;
            }
        }
    }
}

