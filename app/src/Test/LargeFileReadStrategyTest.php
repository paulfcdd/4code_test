<?php

declare(strict_types=1);

namespace App\Test;

use App\Controller\LargeFileReadStrategy;
use PHPUnit\Framework\TestCase;

final class LargeFileReadStrategyTest extends TestCase {
    private $filePath = __DIR__ . '/../../bin/file.txt';

    public function testGetLines(): void {
        $strategy = new LargeFileReadStrategy();
        $generator = $strategy->getLines($this->filePath);

        $this->assertInstanceOf(\Generator::class, $generator);

        $lines = iterator_to_array($generator);

        $this->assertIsArray($lines);
        $this->assertNotEmpty($lines);

        // Checking first line
        $this->assertEquals('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', trim($lines[0]));

        // Checking last line
        $this->assertEquals('Nam porttitor sagittis gravida. Nam sed porta nisi. Sed eleifend sagittis ipsum, ac imperdiet erat blandit sed.', end($lines));
    }
}
