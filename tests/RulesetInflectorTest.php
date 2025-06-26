<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Patterns;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Substitutions;
use Doctrine\Inflector\Rules\Transformations;
use Doctrine\Inflector\Rules\Word;
use Doctrine\Inflector\RulesetInflector;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RulesetInflectorTest extends TestCase
{
    /** @var Ruleset|MockObject */
    private $firstRuleset;

    /** @var Ruleset|MockObject */
    private $secondRuleset;

    /** @var RulesetInflector */
    private $rulesetInflector;

    public function testInflectIrregularUsesFirstMatch(): void
    {
        $firstIrregular  = $this->createMock(Substitutions::class);
        $secondIrregular = $this->createMock(Substitutions::class);

        $this->firstRuleset
            ->method('getIrregular')
            ->willReturn($firstIrregular);

        $this->secondRuleset
            ->method('getIrregular')
            ->willReturn($secondIrregular);

        $firstIrregular->expects(self::once())
            ->method('inflect')
            ->with('in')
            ->willReturn('first');

        $secondIrregular->expects(self::never())
            ->method('inflect');

        self::assertSame('first', $this->rulesetInflector->inflect('in'));
    }

    public function testInflectIrregularContinuesIfFirstRulesetReturnsOriginalValue(): void
    {
        $firstRuleset = new Ruleset(
            new Transformations(),
            new Patterns(),
            new Substitutions()
        );

        $secondRuleset = new Ruleset(
            new Transformations(),
            new Patterns(),
            new Substitutions(new Substitution(new Word('in'), new Word('second')))
        );

        $inflector = new RulesetInflector($firstRuleset, $secondRuleset);

        self::assertSame('second', $inflector->inflect('in'));
    }

    public function testInflectUninflectedSkipsOnFirstMatch(): void
    {
        $firstUninflected  = $this->createMock(Patterns::class);
        $secondUninflected = $this->createMock(Patterns::class);

        $this->firstRuleset
            ->method('getUninflected')
            ->willReturn($firstUninflected);

        $this->secondRuleset
            ->method('getUninflected')
            ->willReturn($secondUninflected);

        $firstUninflected->expects(self::once())
            ->method('matches')
            ->with('in')
            ->willReturn(true);

        $secondUninflected->expects(self::never())
            ->method('matches');

        self::assertSame('in', $this->rulesetInflector->inflect('in'));
    }

    public function testIrregularIsInflectedEvenIfLaterRulesetIgnores(): void
    {
        $firstIrregular    = new Substitutions(new Substitution(new Word('travel'), new Word('travels')));
        $secondUninflected = new Patterns(new Pattern('travel'));

        $this->firstRuleset
            ->method('getIrregular')
            ->willReturn($firstIrregular);

        $this->secondRuleset
            ->method('getUninflected')
            ->willReturn($secondUninflected);

        self::assertSame('travels', $this->rulesetInflector->inflect('travel'));
    }

    public function testInflectRegularUsesFirstMatch(): void
    {
        $irregular = $this->createMock(Substitutions::class);

        $this->firstRuleset
            ->method('getIrregular')
            ->willReturn($irregular);

        $this->secondRuleset
            ->method('getIrregular')
            ->willReturn($irregular);

        $irregular
            ->method('inflect')
            ->with('in')
            ->willReturn('in');

        $uninflected = $this->createMock(Patterns::class);

        $this->firstRuleset
            ->method('getUninflected')
            ->willReturn($uninflected);

        $this->secondRuleset
            ->method('getUninflected')
            ->willReturn($uninflected);

        $uninflected
            ->method('matches')
            ->with('in')
            ->willReturn(false);

        $firstRegular  = $this->createMock(Transformations::class);
        $secondRegular = $this->createMock(Transformations::class);

        $this->firstRuleset
            ->method('getRegular')
            ->willReturn($firstRegular);

        $this->secondRuleset
            ->method('getRegular')
            ->willReturn($secondRegular);

        $firstRegular->expects(self::once())
            ->method('inflect')
            ->with('in')
            ->willReturn('first');

        $secondRegular->expects(self::never())
            ->method('inflect');

        self::assertSame('first', $this->rulesetInflector->inflect('in'));
    }

    public function testInflectRegularContinuesIfFirstRulesetReturnsOriginalValue(): void
    {
        $irregular = $this->createMock(Substitutions::class);

        $this->firstRuleset
            ->method('getIrregular')
            ->willReturn($irregular);

        $this->secondRuleset
            ->method('getIrregular')
            ->willReturn($irregular);

        $irregular
            ->method('inflect')
            ->with('in')
            ->willReturn('in');

        $uninflected = $this->createMock(Patterns::class);

        $this->firstRuleset
            ->method('getUninflected')
            ->willReturn($uninflected);

        $this->secondRuleset
            ->method('getUninflected')
            ->willReturn($uninflected);

        $uninflected
            ->method('matches')
            ->with('in')
            ->willReturn(false);

        $firstRegular  = $this->createMock(Transformations::class);
        $secondRegular = $this->createMock(Transformations::class);

        $this->firstRuleset
            ->method('getRegular')
            ->willReturn($firstRegular);

        $this->secondRuleset
            ->method('getRegular')
            ->willReturn($secondRegular);

        $firstRegular->expects(self::once())
            ->method('inflect')
            ->with('in')
            ->willReturn('in');

        $secondRegular->expects(self::once())
            ->method('inflect')
            ->with('in')
            ->willReturn('second');

        self::assertSame('second', $this->rulesetInflector->inflect('in'));
    }

    public function testInflectReturnsOriginalValueOnNoMatches(): void
    {
        $irregular = $this->createMock(Substitutions::class);

        $this->firstRuleset
            ->method('getIrregular')
            ->willReturn($irregular);

        $this->secondRuleset
            ->method('getIrregular')
            ->willReturn($irregular);

        $irregular
            ->method('inflect')
            ->with('in')
            ->willReturn('in');

        $uninflected = $this->createMock(Patterns::class);

        $this->firstRuleset
            ->method('getUninflected')
            ->willReturn($uninflected);

        $this->secondRuleset
            ->method('getUninflected')
            ->willReturn($uninflected);

        $uninflected
            ->method('matches')
            ->with('in')
            ->willReturn(false);

        $regular = $this->createMock(Transformations::class);

        $this->firstRuleset
            ->method('getRegular')
            ->willReturn($regular);

        $this->secondRuleset
            ->method('getRegular')
            ->willReturn($regular);

        $regular
            ->method('inflect')
            ->with('in')
            ->willReturn('in');

        self::assertSame('in', $this->rulesetInflector->inflect('in'));
    }

    protected function setUp(): void
    {
        $this->firstRuleset  = $this->createMock(Ruleset::class);
        $this->secondRuleset = $this->createMock(Ruleset::class);

        $this->rulesetInflector = new RulesetInflector($this->firstRuleset, $this->secondRuleset);
    }
}
