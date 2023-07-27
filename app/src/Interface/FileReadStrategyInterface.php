<?php

declare(strict_types=1);

namespace App\Interface;

interface FileReadStrategyInterface
{
    public function getLines(string $filePath): \Generator;
}