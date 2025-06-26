<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Word;
use PHPUnit\Framework\TestCase;

class SubstitutionTest extends TestCase
{
    /** @var Substitution */
    private $substitution;

    public function testGetFrom(): void
    {
        self::assertSame('from', $this->substitution->getFrom()->getWord());
    }

    public function testGetTo(): void
    {
        self::assertSame('to', $this->substitution->getTo()->getWord());
    }

    protected function setUp(): void
    {
        $this->substitution = new Substitution(new Word('from'), new Word('to'));
    }
}
