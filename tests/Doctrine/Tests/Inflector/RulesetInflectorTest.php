<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\Rules\Irregular;
use Doctrine\Inflector\Rules\Rules;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Uninflected;
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
        /** @var Irregular|MockObject $irregular */
        $irregular = $this->createMock(Irregular::class);

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
        /** @var Uninflected|MockObject $uninflected */
        $uninflected = $this->createMock(Uninflected::class);

        $uninflected = $this->createMock(Uninflected::class);

        $this->ruleset->expects(self::once())
            ->method('getUninflected')
            ->willReturn($uninflected);

        $uninflected->expects(self::once())
            ->method('isUninflected')
            ->with('in')
            ->willReturn(true);

        self::assertSame('in', $this->rulesetInflector->inflect('in'));
    }

    public function testInflectRules() : void
    {
        /** @var Irregular|MockObject $irregular */
        $irregular = $this->createMock(Irregular::class);

        /** @var Uninflected|MockObject $uninflected */
        $uninflected = $this->createMock(Uninflected::class);

        /** @var Rules|MockObject $rules */
        $regular = $this->createMock(Rules::class);

        $this->ruleset->expects(self::once())
            ->method('getIrregular')
            ->willReturn($irregular);

        $irregular->expects(self::once())
            ->method('inflect')
            ->with('in')
            ->willReturn('in');

        $uninflected = $this->createMock(Uninflected::class);

        $this->ruleset->expects(self::once())
            ->method('getUninflected')
            ->willReturn($uninflected);

        $uninflected->expects(self::once())
            ->method('isUninflected')
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
