<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\WordInflector;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class InflectorTest extends TestCase
{
    /** @var WordInflector|MockObject */
    private $singularInflector;

    /** @var WordInflector|MockObject */
    private $pluralInflector;

    /** @var Inflector */
    private $inflector;

    public function testTableize() : void
    {
        self::assertSame('model_name', $this->inflector->tableize('ModelName'));
        self::assertSame('model_name', $this->inflector->tableize('modelName'));
        self::assertSame('model_name', $this->inflector->tableize('model_name'));
    }

    public function testClassify() : void
    {
        self::assertSame('ModelName', $this->inflector->classify('model_name'));
        self::assertSame('ModelName', $this->inflector->classify('modelName'));
        self::assertSame('ModelName', $this->inflector->classify('ModelName'));
    }

    public function testCamelize() : void
    {
        self::assertSame('modelName', $this->inflector->camelize('ModelName'));
        self::assertSame('modelName', $this->inflector->camelize('model_name'));
        self::assertSame('modelName', $this->inflector->camelize('modelName'));
    }

    public function testCapitalize() : void
    {
        self::assertSame(
            'Top-O-The-Morning To All_of_you!',
            $this->inflector->capitalize('top-o-the-morning to all_of_you!')
        );
    }

    public function testPluralize() : void
    {
        $this->pluralInflector->expects($this->once())
            ->method('inflect')
            ->with('in')
            ->willReturn('out');

        self::assertSame('out', $this->inflector->pluralize('in'));
    }

    public function testSingularize() : void
    {
        $this->singularInflector->expects($this->once())
            ->method('inflect')
            ->with('in')
            ->willReturn('out');

        self::assertSame('out', $this->inflector->singularize('in'));
    }

    protected function setUp() : void
    {
        $this->singularInflector = $this->createMock(WordInflector::class);
        $this->pluralInflector   = $this->createMock(WordInflector::class);

        $this->inflector = new Inflector($this->singularInflector, $this->pluralInflector);
    }
}
