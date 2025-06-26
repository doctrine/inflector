<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Substitutions;
use Doctrine\Inflector\Rules\Word;
use PHPUnit\Framework\TestCase;

class SubstitutionsTest extends TestCase
{
    /** @var Substitution[] */
    private $substitutions;

    /** @var Substitutions */
    private $irregular;

    public function testGetFlippedSubstitutions(): void
    {
        $substitutions = $this->irregular->getFlippedSubstitutions();

        self::assertSame('spins', $substitutions->inflect('spinor'));
    }

    public function testInflect(): void
    {
        self::assertSame('spinor', $this->irregular->inflect('spins'));
    }

    protected function setUp(): void
    {
        $this->substitutions = [
            new Substitution(new Word('spins'), new Word('spinor')),
        ];

        $this->irregular = new Substitutions(...$this->substitutions);
    }
}
