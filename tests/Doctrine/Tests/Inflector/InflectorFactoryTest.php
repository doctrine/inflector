<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Rules\Irregular;
use Doctrine\Inflector\Rules\Rule;
use Doctrine\Inflector\Rules\Rules;
use Doctrine\Inflector\Rules\Uninflected;
use Doctrine\Inflector\Rules\Word;
use PHPUnit\Framework\TestCase;

class InflectorFactoryTest extends TestCase
{
    /** @var InflectorFactory */
    private $inflectorFactory;

    public function testCreateInflector() : void
    {
        $inflector = $this->inflectorFactory->createInflector();

        self::assertSame('apple', $inflector->singularize('apples'));
    }

    public function testCreatorInflectorCustom() : void
    {
        $inflector = $this->inflectorFactory->createInflector(
            $this->inflectorFactory->createSingularRuleset(
                new Rules(
                    new Rule('/^(bil)er$/i', '\1'),
                    new Rule('/^(inflec|contribu)tors$/i', '\1ta')
                ),
                new Uninflected(new Word('singulars')),
                new Irregular(new Rule('spins', 'spinor'))
            ),
            $this->inflectorFactory->createPluralRuleset(
                new Rules(new Rule('/^(alert)$/i', '\1ables')),
                new Uninflected(new Word('noflect'), new Word('abtuse')),
                new Irregular(
                    new Rule('amaze', 'amazable'),
                    new Rule('phone', 'phonezes')
                )
            )
        );

        self::assertSame('inflecta', $inflector->singularize('inflectors'));
        self::assertSame('contributa', $inflector->singularize('contributors'));
        self::assertSame('spinor', $inflector->singularize('spins'));
        self::assertSame('singulars', $inflector->singularize('singulars'));
    }

    protected function setUp() : void
    {
        $this->inflectorFactory = new InflectorFactory();
    }
}
