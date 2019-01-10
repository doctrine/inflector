<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\InflectorFactory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class InflectorFactoryTest extends TestCase
{
    public function testCreateThrowsInvalidArgumentExceptionForUnsupportedLanguage() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Language "invalid" is not supported.');

        (new InflectorFactory())('invalid');
    }
}
