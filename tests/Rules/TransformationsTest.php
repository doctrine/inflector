<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Transformation;
use Doctrine\Inflector\Rules\Transformations;
use PHPUnit\Framework\TestCase;

class TransformationsTest extends TestCase
{
    /** @var Transformations */
    private $transformations;

    public function testInflect(): void
    {
        self::assertSame('customizables', $this->transformations->inflect('custom'));
    }

    protected function setUp(): void
    {
        $this->transformations = new Transformations(new Transformation(new Pattern('/^(custom)$/i'), '\1izables'));
    }
}
