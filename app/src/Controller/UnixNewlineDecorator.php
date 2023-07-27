<?php

declare(strict_types=1);

namespace App\Controller;

use App\Interface\LineReaderInterface;

readonly class UnixNewlineDecorator implements LineReaderInterface
{
    public function __construct(private LineByLineFileReader $lineReader)
    {}

    public function loadFile(): void
    {
        // TODO: Implement loadFile() method.
    }

    public function getLines(): \Generator {
        foreach ($this->lineReader->getLines() as $line) {
            yield str_replace(["\r\n", "\r"], "\n", $line);
        }
    }
}
