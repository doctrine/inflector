<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class InflectorFunctionalTest extends TestCase
{
    public function testCapitalize(): void
    {
        self::assertSame(
            'Top-O-The-Morning To All_of_you!',
            $this->createInflector()->capitalize('top-o-the-morning to all_of_you!')
        );
    }

    public function testCapitalizeWithCustomDelimiters(): void
    {
        self::assertSame(
            'Top-O-The-Morning To All_Of_You!',
            $this->createInflector()->capitalize('top-o-the-morning to all_of_you!', '-_ ')
        );
    }

    /** @dataProvider dataStringsTableize */
    #[DataProvider('dataStringsTableize')]
    public function testTableize(string $expected, string $word): void
    {
        self::assertSame($expected, $this->createInflector()->tableize($word));
    }

    /**
     * Strings which are used for testTableize.
     *
     * @return string[][]
     */
    public static function dataStringsTableize(): array
    {
        // In the format array('expected', 'word')
        return [
            ['', ''],
            ['foo_bar', 'FooBar'],
            ['f0o_bar', 'F0oBar'],
        ];
    }

    /** @dataProvider dataStringsClassify */
    #[DataProvider('dataStringsClassify')]
    public function testClassify(string $expected, string $word): void
    {
        self::assertSame($expected, $this->createInflector()->classify($word));
    }

    /**
     * Strings which are used for testClassify.
     *
     * @return string[][]
     */
    public static function dataStringsClassify(): array
    {
        // In the format array('expected', 'word')
        return [
            ['', ''],
            ['FooBar', 'foo_bar'],
            ['FooBar', 'foo bar'],
            ['F0oBar', 'f0o bar'],
            ['F0oBar', 'f0o  bar'],
            ['FooBar', 'foo_bar_'],
        ];
    }

    /** @dataProvider dataStringsCamelize */
    #[DataProvider('dataStringsCamelize')]
    public function testCamelize(string $expected, string $word): void
    {
        self::assertSame($expected, $this->createInflector()->camelize($word));
    }

    /**
     * Strings which are used for testCamelize.
     *
     * @return string[][]
     */
    public static function dataStringsCamelize(): array
    {
        // In the format array('expected', 'word')
        return [
            ['', ''],
            ['fooBar', 'foo_bar'],
            ['fooBar', 'foo bar'],
            ['f0oBar', 'f0o bar'],
            ['f0oBar', 'f0o  bar'],
        ];
    }

    private function createInflector(): Inflector
    {
        return InflectorFactory::create()->build();
    }
}
