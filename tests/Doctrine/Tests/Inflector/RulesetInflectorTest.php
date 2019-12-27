<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\Rules\Patterns;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Substitutions;
use Doctrine\Inflector\Rules\Transformations;
use Doctrine\Inflector\RulesetInflector;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RulesetInflectorTest extends TestCase
{
    /** @var Ruleset|MockObject */
    private $ruleset;

    /** @var RulesetInflector */
    private $rulesetInflector;

    public function testInflectIrregular() : void
    {
        $irregular = $this->createMock(Substitutions::class);

        $this->ruleset->expects(self::once())
            ->method('getIrregular')
            ->willReturn($irregular);

        $irregular->expects(self::once())
            ->method('inflect')
            ->with('in')
            ->willReturn('out');

        self::assertSame('out', $this->rulesetInflector->inflect('in'));
    }

    public function testInflectUninflected() : void
    {
        $uninflected = $this->createMock(Patterns::class);

        $this->ruleset->expects(self::once())
            ->method('getUninflected')
            ->willReturn($uninflected);

        $uninflected->expects(self::once())
            ->method('matches')
            ->with('in')
            ->willReturn(true);

        self::assertSame('in', $this->rulesetInflector->inflect('in'));
    }

    public function testInflectRules() : void
    {
        $irregular = $this->createMock(Substitutions::class);

        $uninflected = $this->createMock(Patterns::class);

        $regular = $this->createMock(Transformations::class);

        $this->ruleset->expects(self::once())
            ->method('getIrregular')
            ->willReturn($irregular);

        $irregular->expects(self::once())
            ->method('inflect')
            ->with('in')
            ->willReturn('in');

        $uninflected = $this->createMock(Patterns::class);

        $this->ruleset->expects(self::once())
            ->method('getUninflected')
            ->willReturn($uninflected);

        $uninflected->expects(self::once())
            ->method('matches')
            ->with('in')
            ->willReturn(false);

        $this->ruleset->expects(self::once())
            ->method('getRegular')
            ->willReturn($regular);

        $regular->expects(self::once())
            ->method('inflect')
            ->with('in')
            ->willReturn('out');

        self::assertSame('out', $this->rulesetInflector->inflect('in'));
    }

    protected function setUp() : void
    {
        $this->ruleset = $this->createMock(Ruleset::class);

        $this->rulesetInflector = new RulesetInflector($this->ruleset);
    }
}
