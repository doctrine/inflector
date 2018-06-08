<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Irregular;
use Doctrine\Inflector\Rules\Rules;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Uninflected;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RulesetTest extends TestCase
{
    /** @var Rules|MockObject */
    private $regular;

    /** @var Uninflected|MockObject */
    private $uninflected;

    /** @var Irregular|MockObject */
    private $irregular;

    /** @var Ruleset */
    private $ruleset;

    public function testGetRegular() : void
    {
        self::assertSame($this->regular, $this->ruleset->getRegular());
    }

    public function testGetUninflected() : void
    {
        self::assertSame($this->uninflected, $this->ruleset->getUninflected());
    }

    public function testGetIrregular() : void
    {
        self::assertSame($this->irregular, $this->ruleset->getIrregular());
    }

    protected function setUp() : void
    {
        $this->regular     = $this->createMock(Rules::class);
        $this->uninflected = $this->createMock(Uninflected::class);
        $this->irregular   = $this->createMock(Irregular::class);

        $this->ruleset = new Ruleset(
            $this->regular,
            $this->uninflected,
            $this->irregular
        );
    }
}
