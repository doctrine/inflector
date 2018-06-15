<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Rule;
use Doctrine\Inflector\Rules\Rules;
use PHPUnit\Framework\TestCase;

class RulesTest extends TestCase
{
    /** @var Rules */
    private $rules;

    public function testInflect() : void
    {
        self::assertSame('customizables', $this->rules->inflect('custom'));
    }

    protected function setUp() : void
    {
        $this->rules = new Rules(new Rule('/^(custom)$/i', '\1izables'));
    }
}
