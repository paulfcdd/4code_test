<?php

declare(strict_types=1);

namespace App\Service;

use App\Interface\LineReaderInterface;

class InternetResourceProxy implements LineReaderInterface
{
    private string $filePath;
    private string $internetResourceUrl;
    private LineByLineFileReader $realReader;

    public function __construct(string $filePath, string $internetResourceUrl) {
        $this->filePath = $filePath;
        $this->internetResourceUrl = $internetResourceUrl;
    }

    public function loadFile(): void {
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, file_get_contents($this->internetResourceUrl));
        }


        $this->realReader = new LineByLineFileReader($this->filePath);
        $this->realReader->loadFile();
    }

    public function getLines(): \Generator {
        foreach ($this->realReader->getLines() as $line) {
            yield $line;
        }
    }
}
