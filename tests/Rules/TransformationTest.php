<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Transformation;
use PHPUnit\Framework\TestCase;

class TransformationTest extends TestCase
{
    /** @var Transformation */
    private $transformation;

    public function testGetPattern(): void
    {
        self::assertSame('s$', $this->transformation->getPattern()->getPattern());
    }

    public function testGetReplacement(): void
    {
        self::assertSame('', $this->transformation->getReplacement());
    }

    public function testInflect(): void
    {
        self::assertSame('test', $this->transformation->inflect('tests'));
    }

    protected function setUp(): void
    {
        $this->transformation = new Transformation(new Pattern('s$'), '');
    }
}
