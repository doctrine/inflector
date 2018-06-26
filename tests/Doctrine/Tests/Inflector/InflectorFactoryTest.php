<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\PluralizerFactory;
use Doctrine\Inflector\Rules\Irregular;
use Doctrine\Inflector\Rules\Rule;
use Doctrine\Inflector\Rules\Rules;
use Doctrine\Inflector\Rules\Uninflected;
use Doctrine\Inflector\Rules\Word;
use Doctrine\Inflector\RulesetInflector;
use Doctrine\Inflector\SingularizerFactory;
use PHPUnit\Framework\TestCase;

class InflectorFactoryTest extends TestCase
{
    public function testCreatorInflector() : void
    {
        self::assertTrue(true);

        $singularRuleset = (new SingularizerFactory())
            ->withRules(new Rules(
                new Rule('/^(bil)er$/i', '\1'),
                new Rule('/^(inflec|contribu)tors$/i', '\1ta')
            ))
            ->withUninflected(new Uninflected(new Word('singulars')))
            ->withIrregular(new Irregular(new Rule('spins', 'spinor')))
            ->build();

        $pluralRuleset = (new PluralizerFactory())
            ->withRules(new Rules(new Rule('/^(alert)$/i', '\1ables')))
            ->withUninflected(new Uninflected(new Word('noflect'), new Word('abtuse')))
            ->withIrregular(
                new Irregular(
                    new Rule('amaze', 'amazable'),
                    new Rule('phone', 'phonezes')
                )
            )
            ->build();

        $inflector = (new InflectorFactory())
            ->withSingularInflector(new RulesetInflector($singularRuleset))
            ->withPluralInflector(new RulesetInflector($pluralRuleset))
            ->build()
        ;

        self::assertSame('inflecta', $inflector->singularize('inflectors'));
        self::assertSame('contributa', $inflector->singularize('contributors'));
        self::assertSame('spinor', $inflector->singularize('spins'));
        self::assertSame('singulars', $inflector->singularize('singulars'));
    }
}
