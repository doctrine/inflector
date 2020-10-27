<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Pattern;
use PHPUnit\Framework\TestCase;

class PatternTest extends TestCase
{
    /** @var Pattern */
    private $pattern;

    public function testGetPattern(): void
    {
        self::assertSame('test', $this->pattern->getPattern());
    }

    public function testGetRegex(): void
    {
        self::assertSame('/test/i', $this->pattern->getRegex());
    }

    public function testPatternWithExplicitRegex(): void
    {
        $pattern = new Pattern('/test/');

        self::assertSame('/test/', $pattern->getRegex());
    }

    public function testMatches(): void
    {
        self::assertTrue($this->pattern->matches('test'));
    }

    protected function setUp(): void
    {
        $this->pattern = new Pattern('test');
    }
}
