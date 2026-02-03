<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\NoopWordInflector;
use Override;
use PHPUnit\Framework\TestCase;

class NoopWordInflectorTest extends TestCase
{
    private NoopWordInflector $inflector;

    public function testInflect(): void
    {
        self::assertSame('foo', $this->inflector->inflect('foo'));
        self::assertSame('bar', $this->inflector->inflect('bar'));
    }

    #[Override]
    protected function setUp(): void
    {
        $this->inflector = new NoopWordInflector();
    }
}
