<?php

declare(strict_types=1);

namespace App\Test;

use App\Controller\FileReader;
use App\Controller\LargeFileReadStrategy;
use App\Controller\SmallFileReadStrategy;
use PHPUnit\Framework\TestCase;

final class FileReaderTest extends TestCase
{
    private $filePath = __DIR__ . '/../../bin/file.txt';


    public function testSmallFileReadStrategy(): void {
        $strategy = new SmallFileReadStrategy();
        $generator = $strategy->getLines($this->filePath);

        $this->assertInstanceOf(\Generator::class, $generator);
    }

    public function testLargeFileReadStrategy(): void {
        $strategy = new LargeFileReadStrategy();
        $generator = $strategy->getLines($this->filePath);

        $this->assertInstanceOf(\Generator::class, $generator);
    }

    public function testFileReaderSmallFile(): void {
        $reader = new FileReader();
        $generator = $reader->getLines($this->filePath);

        $this->assertInstanceOf(\Generator::class, $generator);
    }

    public function testFileReaderLargeFile(): void {
        $reader = new FileReader();
        $generator = $reader->getLines($this->filePath);

        $this->assertInstanceOf(\Generator::class, $generator);
    }
}
