<?php

declare(strict_types=1);

namespace App\Interface;
interface LineReaderInterface
{
    public function getLines(): \Generator;
    public function loadFile(): void;
}