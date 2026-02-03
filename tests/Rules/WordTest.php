<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Word;
use Override;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    private Word $word;

    public function testGetWord(): void
    {
        self::assertSame('test', $this->word->getWord());
    }

    #[Override]
    protected function setUp(): void
    {
        $this->word = new Word('test');
    }
}
