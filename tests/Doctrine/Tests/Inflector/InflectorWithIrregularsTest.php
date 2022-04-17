<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use PHPUnit\Framework\TestCase;

class InflectorWithIrregularsTest extends TestCase
{
    /** @var Inflector */
    private $inflector;

    /**
     * @dataProvider dataIrregulars
     */
    public function testIrregulars(string $word, string $expected): void
    {
        self::assertSame($expected, $this->inflector->pluralize($word));
        self::assertSame($word, $this->inflector->singularize($expected));
    }

    /**
     * @dataProvider dataRegulars
     */
    public function testRegulars(string $word, string $expected): void
    {
        self::assertSame($expected, $this->inflector->pluralize($word));
        self::assertSame($word, $this->inflector->singularize($expected));
    }

    /**
     * Strings which are used for testTableize.
     *
     * @return string[][]
     */
    public function dataRegulars(): array
    {
        // In the format array('word', 'expected')
        return [
            ['address', 'addresses'],
            ['advice', 'advice'],
            ['agency', 'agencies'],
            ['aircraft', 'aircraft'],
            ['alias', 'aliases'],
        ];
    }

    /**
     * Strings which are used for testIrregulars.
     *
     * @return string[][]
     */
    public function dataIrregulars(): array
    {
        // In the format array('word', 'expected')
        return [
            ['foobar', 'barfoo'],
            ['test', 'testz'],
        ];
    }

    protected function setUp(): void
    {
        $this->inflector = InflectorFactory::create()->withIrregulars($this->dataIrregulars())->build();
    }
}
