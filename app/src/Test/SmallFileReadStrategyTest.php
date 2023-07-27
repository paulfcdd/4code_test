<?php

declare(strict_types=1);

namespace App\Test;

use App\Controller\SmallFileReadStrategy;
use PHPUnit\Framework\TestCase;

final class SmallFileReadStrategyTest extends TestCase
{
    private $filePath = __DIR__ . '/../../bin/file.txt';

    public function testGetLines(): void {
        $strategy = new SmallFileReadStrategy();
        $generator = $strategy->getLines($this->filePath);

        $this->assertInstanceOf(\Generator::class, $generator);

        $lines = iterator_to_array($generator);

        $this->assertIsArray($lines);
        $this->assertNotEmpty($lines);

        // Checking first line
        $this->assertEquals(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            $lines[0]);

        // Checking last line
        $this->assertEquals(
            'Nam porttitor sagittis gravida. Nam sed porta nisi. Sed eleifend sagittis ipsum, ac imperdiet erat blandit sed.',
            end($lines));
    }
}
