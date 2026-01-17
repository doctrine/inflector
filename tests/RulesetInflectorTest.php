<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Patterns;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Substitutions;
use Doctrine\Inflector\Rules\Transformation;
use Doctrine\Inflector\Rules\Transformations;
use Doctrine\Inflector\Rules\Word;
use Doctrine\Inflector\RulesetInflector;
use PHPUnit\Framework\TestCase;

class RulesetInflectorTest extends TestCase
{
    public function testInflectIrregularUsesFirstMatch(): void
    {
        $inflector = new RulesetInflector(
            new Ruleset(
                new Transformations(),
                new Patterns(),
                new Substitutions(new Substitution(new Word('in'), new Word('first')))
            ),
            new Ruleset(
                new Transformations(),
                new Patterns(),
                new Substitutions(new Substitution(new Word('in'), new Word('second')))
            )
        );

        self::assertSame('first', $inflector->inflect('in'));
    }

    public function testInflectIrregularContinuesIfFirstRulesetReturnsOriginalValue(): void
    {
        $inflector = new RulesetInflector(
            new Ruleset(
                new Transformations(),
                new Patterns(),
                new Substitutions()
            ),
            new Ruleset(
                new Transformations(),
                new Patterns(),
                new Substitutions(new Substitution(new Word('in'), new Word('second')))
            )
        );

        self::assertSame('second', $inflector->inflect('in'));
    }

    public function testInflectUninflectedSkipsOnFirstMatch(): void
    {
        $inflector = new RulesetInflector(
            new Ruleset(
                new Transformations(),
                new Patterns(new Pattern('in')),
                new Substitutions()
            ),
            new Ruleset(
                new Transformations(new Transformation(new Pattern('in'), 'should-not-reach')),
                new Patterns(),
                new Substitutions()
            )
        );

        self::assertSame('in', $inflector->inflect('in'));
    }

    public function testIrregularIsInflectedEvenIfLaterRulesetIgnores(): void
    {
        $inflector = new RulesetInflector(
            new Ruleset(
                new Transformations(),
                new Patterns(),
                new Substitutions(new Substitution(new Word('travel'), new Word('travels')))
            ),
            new Ruleset(
                new Transformations(),
                new Patterns(new Pattern('travel')),
                new Substitutions()
            )
        );

        self::assertSame('travels', $inflector->inflect('travel'));
    }

    public function testInflectRegularUsesFirstMatch(): void
    {
        $inflector = new RulesetInflector(
            new Ruleset(
                new Transformations(new Transformation(new Pattern('in'), 'first')),
                new Patterns(),
                new Substitutions()
            ),
            new Ruleset(
                new Transformations(new Transformation(new Pattern('in'), 'second')),
                new Patterns(),
                new Substitutions()
            ),
        );

        self::assertSame('first', $inflector->inflect('in'));
    }

    public function testInflectRegularContinuesIfFirstRulesetReturnsOriginalValue(): void
    {
        $inflector = new RulesetInflector(
            new Ruleset(
                new Transformations(new Transformation(new Pattern('nomatch'), 'first')),
                new Patterns(),
                new Substitutions()
            ),
            new Ruleset(
                new Transformations(new Transformation(new Pattern('in'), 'second')),
                new Patterns(),
                new Substitutions()
            )
        );

        self::assertSame('second', $inflector->inflect('in'));
    }

    public function testInflectReturnsOriginalValueOnNoMatches(): void
    {
        $inflector = new RulesetInflector(
            new Ruleset(
                new Transformations(new Transformation(new Pattern('nomatch'), 'replaced')),
                new Patterns(),
                new Substitutions()
            ),
            new Ruleset(
                new Transformations(new Transformation(new Pattern('nomatch'), 'replaced')),
                new Patterns(),
                new Substitutions()
            )
        );

        self::assertSame('in', $inflector->inflect('in'));
    }
}
