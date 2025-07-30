<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;
use Doctrine\Inflector\LanguageInflectorFactory;
use Doctrine\Inflector\Rules\English\InflectorFactory as EnglishInflectorFactory;
use Doctrine\Inflector\Rules\Esperanto\InflectorFactory as EsperantoInflectorFactory;
use Doctrine\Inflector\Rules\French\InflectorFactory as FrenchInflectorFactory;
use Doctrine\Inflector\Rules\NorwegianBokmal\InflectorFactory as NorwegianBokmalInflectorFactory;
use Doctrine\Inflector\Rules\Portuguese\InflectorFactory as PortugueseInflectorFactory;
use Doctrine\Inflector\Rules\Spanish\InflectorFactory as SpanishInflectorFactory;
use Doctrine\Inflector\Rules\Turkish\InflectorFactory as TurkishInflectorFactory;
use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class InflectorFactoryTest extends TestCase
{
    public function testCreateUsesEnglishByDefault(): void
    {
        self::assertInstanceOf(EnglishInflectorFactory::class, InflectorFactory::create());
    }

    /**
     * @phpstan-param class-string<LanguageInflectorFactory> $expectedClass
     *
     * @dataProvider provideLanguages
     */
    #[DataProvider('provideLanguages')]
    public function testCreateForLanguageWithCustomLanguage(string $expectedClass, string $language): void
    {
        self::assertInstanceOf($expectedClass, InflectorFactory::createForLanguage($language));
    }

    /** @phpstan-return Generator<string, array{class-string<LanguageInflectorFactory>, Language::*}> */
    public static function provideLanguages(): Generator
    {
        yield 'English' => [EnglishInflectorFactory::class, Language::ENGLISH];
        yield 'Esperanto' => [EsperantoInflectorFactory::class, Language::ESPERANTO];
        yield 'French' => [FrenchInflectorFactory::class, Language::FRENCH];
        yield 'Norwegian Bokmal' => [NorwegianBokmalInflectorFactory::class, Language::NORWEGIAN_BOKMAL];
        yield 'Portuguese' => [PortugueseInflectorFactory::class, Language::PORTUGUESE];
        yield 'Spanish' => [SpanishInflectorFactory::class, Language::SPANISH];
        yield 'Turkish' => [TurkishInflectorFactory::class, Language::TURKISH];
    }

    public function testCreateForLanguageThrowsInvalidArgumentExceptionForUnsupportedLanguage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Language "invalid" is not supported.');

        InflectorFactory::createForLanguage('invalid')->build();
    }
}
