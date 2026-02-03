<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Patterns;
use Override;
use PHPUnit\Framework\TestCase;

class PatternsTest extends TestCase
{
    private Patterns $patterns;

    public function testMatches(): void
    {
        self::assertTrue($this->patterns->matches('test1'));
        self::assertFalse($this->patterns->matches('test2'));
    }

    #[Override]
    protected function setUp(): void
    {
        $this->patterns = new Patterns(new Pattern('test1'));
    }
}
