<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\NoopInflector;
use PHPUnit\Framework\TestCase;

class NoopInflectorTest extends TestCase
{
    /** @var NoopInflector */
    private $noopInflector;

    public function testInflect() : void
    {
        self::assertSame('foo', $this->noopInflector->inflect('foo'));
        self::assertSame('bar', $this->noopInflector->inflect('bar'));
    }

    protected function setUp() : void
    {
        $this->noopInflector = new NoopInflector();
    }
}
