<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\CachedWordInflector;
use Doctrine\Inflector\WordInflector;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CachedWordInflectorTest extends TestCase
{
    /** @var WordInflector&MockObject */
    private $wordInflector;

    /** @var CachedWordInflector */
    private $cachedWordInflector;

    public function testInflect(): void
    {
        $this->wordInflector->expects(self::once())
            ->method('inflect')
            ->with('in')
            ->willReturn('out');

        self::assertSame('out', $this->cachedWordInflector->inflect('in'));
        self::assertSame('out', $this->cachedWordInflector->inflect('in'));
    }

    protected function setUp(): void
    {
        $this->wordInflector = $this->createMock(WordInflector::class);

        $this->cachedWordInflector = new CachedWordInflector(
            $this->wordInflector
        );
    }
}
