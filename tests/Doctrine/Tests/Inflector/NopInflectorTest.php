<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\NopInflector;
use PHPUnit\Framework\TestCase;

class NopInflectorTest extends TestCase
{
    /** @var NopInflector */
    private $nopInflector;

    public function testInflect() : void
    {
        self::assertSame('foo', $this->nopInflector->inflect('foo'));
        self::assertSame('bar', $this->nopInflector->inflect('bar'));
    }

    protected function setUp() : void
    {
        $this->nopInflector = new NopInflector();
    }
}
