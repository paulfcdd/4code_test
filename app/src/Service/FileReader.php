<?php

declare(strict_types=1);

namespace App\Service;

class FileReader
{
    private const FILE_SIZE_THRESHOLD = 1 * 1024 * 1024; // 1MB

    private $strategy;

    public function __construct() {
        $this->strategy = new SmallFileReadStrategy();
    }

    public function setStrategyBasedOnFileSize(string $filePath): void {
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException("File not found: $filePath");
        }

        $fileSize = filesize($filePath);

        if ($fileSize === false) {
            throw new \RuntimeException("Could not get the size of the file: $filePath");
        }

        if ($fileSize < self::FILE_SIZE_THRESHOLD) {
            $this->strategy = new SmallFileReadStrategy();
        } else {
            $this->strategy = new LargeFileReadStrategy();
        }
    }

    public function getLines(string $filePath): \Generator {
        $this->setStrategyBasedOnFileSize($filePath);
        return $this->strategy->getLines($filePath);
    }
}
