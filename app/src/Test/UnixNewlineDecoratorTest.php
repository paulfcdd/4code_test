<?php

declare(strict_types=1);

namespace App\Test;

use App\Controller\LineByLineFileReader;
use App\Controller\UnixNewlineDecorator;
use PHPUnit\Framework\TestCase;

final class UnixNewlineDecoratorTest extends TestCase {
    private $filePath = __DIR__ . '/../../bin/file.txt';

    public function testGetLines(): void {
        $reader = new LineByLineFileReader($this->filePath);
        $reader->loadFile();

        $decorator = new UnixNewlineDecorator($reader);

        $lines = iterator_to_array($decorator->getLines());

        $this->assertIsArray($lines);
        $this->assertNotEmpty($lines);

        foreach ($lines as $line) {
            // Checking if the line has any CR or CRLF characters
            $this->assertFalse(strpos($line, "\r\n"));
            $this->assertFalse(strpos($line, "\r"));
        }
    }
}
