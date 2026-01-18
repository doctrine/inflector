<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Patterns;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Substitutions;
use Doctrine\Inflector\Rules\Transformation;
use Doctrine\Inflector\Rules\Transformations;
use Doctrine\Inflector\Rules\Word;
use PHPUnit\Framework\TestCase;

class RulesetTest extends TestCase
{
    /** @var Transformations */
    private $regular;

    /** @var Patterns */
    private $uninflected;

    /** @var Substitutions */
    private $irregular;

    /** @var Ruleset */
    private $ruleset;

    public function testGetRegular(): void
    {
        self::assertSame($this->regular, $this->ruleset->getRegular());
    }

    public function testGetUninflected(): void
    {
        self::assertSame($this->uninflected, $this->ruleset->getUninflected());
    }

    public function testGetIrregular(): void
    {
        self::assertSame($this->irregular, $this->ruleset->getIrregular());
    }

    protected function setUp(): void
    {
        $this->regular     = new Transformations(
            new Transformation(new Pattern('test'), 'tests')
        );
        $this->uninflected = new Patterns(new Pattern('uninflected'));
        $this->irregular   = new Substitutions(
            new Substitution(new Word('test'), new Word('tests'))
        );

        $this->ruleset = new Ruleset(
            $this->regular,
            $this->uninflected,
            $this->irregular
        );
    }
}
