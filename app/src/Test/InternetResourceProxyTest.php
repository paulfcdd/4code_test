<?php

declare(strict_types=1);

namespace App\Test;

use App\Service\InternetResourceProxy;
use PHPUnit\Framework\TestCase;
use phpmock\phpunit\PHPMock;

final class InternetResourceProxyTest extends TestCase {
    use PHPMock;

    private $filePath = __DIR__ . '/../../bin/file.txt';
    private $url = 'https://digilife.com.pl/test.txt';

    public function testLoadFile(): void {
        // Mock global functions in App\Controller namespace
        $namespace = 'App\Controller';

        // Mock file_exists
        $fileExists = $this->getFunctionMock($namespace, 'file_exists');
        $fileExists->expects($this->any())->willReturn(false);

        // Mock file_get_contents
        $fileGetContents = $this->getFunctionMock($namespace, 'file_get_contents');
        $fileGetContents->expects($this->once())->willReturn("line1\nline2\nline3\n");

        // Mock file_put_contents
        $filePutContents = $this->getFunctionMock($namespace, 'file_put_contents');
        $filePutContents->expects($this->once());

        $proxy = new InternetResourceProxy($this->filePath, $this->url);
        $proxy->loadFile();
    }

    public function testGetLines(): void {
        $proxy = new InternetResourceProxy($this->filePath, $this->url);
        $proxy->loadFile();
        $lines = $proxy->getLines();

        $this->assertInstanceOf(\Generator::class, $lines);
        $this->assertEquals(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            trim($lines->current()));
    }
}
