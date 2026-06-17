<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\English;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;
use Doctrine\Tests\Inflector\Rules\LanguageFunctionalTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

use function sprintf;

class PersianFunctionalTest extends LanguageFunctionalTestCase
{
    /** @return string[][] */
    public static function dataSampleWords(): array
    {
        return [
            ['', ''],
            ['پادشاه', 'پادشاهان'],
            ['مکان', 'مکان‌ها'],
        ];
    }

    /**
     * Mixed plural test data.
     *
     * A list of mixed plurals that should be converted to singular.
     * Returns an array of sample words.
     *
     * @return string[][]
     */
    public static function dataMixedPluralShouldBeConvertedToSingular(): array
    {
        return [
            ['اماکن', 'مکان'],
        ];
    }

    #[DataProvider('dataMixedPluralShouldBeConvertedToSingular')]
    public function testMixedPluralShouldBeConvertedToSingular(string $mixedPlural, string $singular): void
    {
        self::assertSame(
            $singular,
            $this->createInflector()->singularize($mixedPlural),
            sprintf("'%s' should be singularized to '%s' because it is a mixed plural", $mixedPlural, $singular)
        );
        self::assertNotSame(
            $singular,
            $this->createInflector()->pluralize($singular),
            sprintf("'%s' should not be pluralized to '%s' because it is a mixed plural", $singular, $mixedPlural)
        );
    }

    /**
     * Singulars as Plural test data.
     *
     * A list of singulars that should not yield the given result if passed through `singularize`.
     * Returns an array of sample words.
     *
     * @return string[][]
     */
    public static function dataSingularsUninflectedWhenSingularized(): array
    {
        // In the format array('singular', 'notEquals')
        return [
            ['مدرک', 'مدرک‌ها'],
        ];
    }

    /** @dataProvider dataSingularsUninflectedWhenSingularized */
    #[DataProvider('dataSingularsUninflectedWhenSingularized')]
    public function testSingularsWhenSingularizedShouldBeUninflected(string $singular, string $notEquals): void
    {
        self::assertNotSame(
            $notEquals,
            $this->createInflector()->singularize($singular),
            sprintf("'%s' should not be singularized to '%s'", $singular, $notEquals)
        );
    }

    /**
     * Words without plural test data.
     *
     * List of words that don't have a plural form.
     *
     * @return string[][]
     */
    public static function dataPluralUninflectedWhenPluralized(): array
    {
        return [
            ['گروه'],
            ['گله'],
        ];
    }

    /** @dataProvider dataPluralUninflectedWhenPluralized */
    #[DataProvider('dataPluralUninflectedWhenPluralized')]
    public function testPluralsWhenPluralizedShouldBeUninflected(string $plural): void
    {
        $pluralized = $this->createInflector()->pluralize($plural);

        self::assertSame(
            $plural,
            $pluralized,
            sprintf("'%s' should not be pluralized to '%s'", $plural, $pluralized)
        );
    }

    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::PERSIAN)->build();
    }
}
