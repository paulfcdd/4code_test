<?php

declare(strict_types=1);

namespace App\Test;

use App\Controller\LineByLineFileReader;
use PHPUnit\Framework\TestCase;

final class LineByLineFileReaderTest extends TestCase {
    private $filePath = __DIR__ . '/../../bin/file.txt';

    public function testLoadFile(): void {
        $reader = new LineByLineFileReader($this->filePath);
        $reader->loadFile();

        $this->assertInstanceOf(\SplFileObject::class, $reader->file);
    }

    public function testGetLines(): void {
        $reader = new LineByLineFileReader($this->filePath);
        $reader->loadFile();

        $lines = iterator_to_array($reader->getLines());

        $this->assertIsArray($lines);
        $this->assertNotEmpty($lines);

        // Checking first line
        $this->assertEquals('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', trim($lines[0]));

        // Checking last line
        $this->assertEquals('Nam porttitor sagittis gravida. Nam sed porta nisi. Sed eleifend sagittis ipsum, ac imperdiet erat blandit sed.', end($lines));
    }
}
