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
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RulesetInflectorTest extends TestCase
{
    /** @dataProvider rulesetProvider */
    #[DataProvider('rulesetProvider')]
    public function testInflect(
        Ruleset $firstRuleset,
        Ruleset $secondRuleset,
        string $input,
        string $expected
    ): void {
        $inflector = new RulesetInflector($firstRuleset, $secondRuleset);

        self::assertSame($expected, $inflector->inflect($input));
    }

    /** @return iterable<string, array{Ruleset, Ruleset, string, string}> */
    public static function rulesetProvider(): iterable
    {
        yield 'irregular uses first match' => [
            new Ruleset(
                new Transformations(),
                new Patterns(),
                new Substitutions(new Substitution(new Word('in'), new Word('first')))
            ),
            new Ruleset(
                new Transformations(),
                new Patterns(),
                new Substitutions(new Substitution(new Word('in'), new Word('second')))
            ),
            'in',
            'first',
        ];

        yield 'irregular continues if first ruleset returns original value' => [
            new Ruleset(
                new Transformations(),
                new Patterns(),
                new Substitutions()
            ),
            new Ruleset(
                new Transformations(),
                new Patterns(),
                new Substitutions(new Substitution(new Word('in'), new Word('second')))
            ),
            'in',
            'second',
        ];

        yield 'uninflected skips on first match' => [
            new Ruleset(
                new Transformations(),
                new Patterns(new Pattern('in')),
                new Substitutions()
            ),
            new Ruleset(
                new Transformations(new Transformation(new Pattern('in'), 'should-not-reach')),
                new Patterns(),
                new Substitutions()
            ),
            'in',
            'in',
        ];

        yield 'irregular is inflected even if later ruleset ignores' => [
            new Ruleset(
                new Transformations(),
                new Patterns(),
                new Substitutions(new Substitution(new Word('travel'), new Word('travels')))
            ),
            new Ruleset(
                new Transformations(),
                new Patterns(new Pattern('travel')),
                new Substitutions()
            ),
            'travel',
            'travels',
        ];

        yield 'regular uses first match' => [
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
            'in',
            'first',
        ];

        yield 'regular continues if first ruleset returns original value' => [
            new Ruleset(
                new Transformations(new Transformation(new Pattern('nomatch'), 'first')),
                new Patterns(),
                new Substitutions()
            ),
            new Ruleset(
                new Transformations(new Transformation(new Pattern('in'), 'second')),
                new Patterns(),
                new Substitutions()
            ),
            'in',
            'second',
        ];

        yield 'returns original value on no matches' => [
            new Ruleset(
                new Transformations(new Transformation(new Pattern('nomatch'), 'replaced')),
                new Patterns(),
                new Substitutions()
            ),
            new Ruleset(
                new Transformations(new Transformation(new Pattern('nomatch'), 'replaced')),
                new Patterns(),
                new Substitutions()
            ),
            'in',
            'in',
        ];
    }
}
