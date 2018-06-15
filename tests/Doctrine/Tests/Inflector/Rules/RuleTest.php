<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Rule;
use PHPUnit\Framework\TestCase;

class RuleTest extends TestCase
{
    /** @var Rule */
    private $rule;

    public function testGetFrom() : void
    {
        self::assertSame('from', $this->rule->getFrom());
    }

    public function testGetTo() : void
    {
        self::assertSame('to', $this->rule->getTo());
    }

    protected function setUp() : void
    {
        $this->rule = new Rule('from', 'to');
    }
}
