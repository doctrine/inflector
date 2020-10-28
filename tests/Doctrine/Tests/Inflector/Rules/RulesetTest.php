<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Patterns;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Substitutions;
use Doctrine\Inflector\Rules\Transformations;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RulesetTest extends TestCase
{
    /** @var Transformations|MockObject */
    private $regular;

    /** @var Patterns|MockObject */
    private $uninflected;

    /** @var Substitutions|MockObject */
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
        $this->regular     = $this->createMock(Transformations::class);
        $this->uninflected = $this->createMock(Patterns::class);
        $this->irregular   = $this->createMock(Substitutions::class);

        $this->ruleset = new Ruleset(
            $this->regular,
            $this->uninflected,
            $this->irregular
        );
    }
}
