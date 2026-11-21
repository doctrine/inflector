<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\Persian;

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
            // Default productive plural with ZWNJ + ها (inanimate / everyday)
            ['کتاب', 'کتاب‌ها'],
            ['خانه', 'خانه‌ها'],
            ['ماشین', 'ماشین‌ها'],
            ['گل', 'گل‌ها'],
            ['مکان', 'مکان‌ها'],
            ['مدرک', 'مدرک‌ها'],
            ['نامه', 'نامه‌ها'],
            ['درخت', 'درخت‌ها'],
            ['سیب', 'سیب‌ها'],
            ['اتاق', 'اتاق‌ها'],
            ['میز', 'میز‌ها'],
            ['صندلی', 'صندلی‌ها'],
            ['شهر', 'شهر‌ها'],
            ['روستا', 'روستا‌ها'],
            ['گربه', 'گربه‌ها'],
            ['سگ', 'سگ‌ها'],
            ['اسب', 'اسب‌ها'],
            ['موش', 'موش‌ها'],
            ['ستاره', 'ستاره‌ها'],
            ['بچه', 'بچه‌ها'],
            ['چشم', 'چشم‌ها'],
            ['دست', 'دست‌ها'],
            ['سخن', 'سخن‌ها'],
            ['میدان', 'میدان‌ها'],
            ['فرمان', 'فرمان‌ها'],
            ['بندر', 'بندر‌ها'],
            ['حیوان', 'حیوان‌ها'],
            // Formal animate plurals (ان)
            ['پادشاه', 'پادشاهان'],
            ['گیاه', 'گیاهان'],
            ['گواه', 'گواهان'],
            ['گناه', 'گناهان'],
            ['شاه', 'شاهان'],
            ['مرد', 'مردان'],
            ['زن', 'زنان'],
            ['دوست', 'دوستان'],
            ['استاد', 'استادان'],
            ['کودک', 'کودکان'],
            ['بزرگ', 'بزرگان'],
            ['دختر', 'دختران'],
            ['پسر', 'پسران'],
            ['برادر', 'برادران'],
            ['خواهر', 'خواهران'],
            ['معلم', 'معلمان'],
            ['کارمند', 'کارمندان'],
            ['سرباز', 'سربازان'],
            ['هنرمند', 'هنرمندان'],
            ['دانشمند', 'دانشمندان'],
            ['وزیر', 'وزیران'],
            ['جانور', 'جانوران'],
            ['عزیز', 'عزیزان'],
            // Formal animate plurals (گان after silent ه)
            ['نویسنده', 'نویسندگان'],
            ['پرنده', 'پرندگان'],
            ['همسایه', 'همسایگان'],
            ['بنده', 'بندگان'],
            ['فرشته', 'فرشتگان'],
            // Formal animate plurals (یان after ا / و / ی)
            ['دانشجو', 'دانشجویان'],
            ['آقا', 'آقایان'],
            ['دانا', 'دانایان'],
            ['سخنگو', 'سخنگویان'],
            ['آشنا', 'آشنایان'],
            ['ایرانی', 'ایرانیان'],
        ];
    }

    /**
     * Mixed plural test data.
     *
     * Arabic broken plurals should singularize to the Persian singular,
     * but pluralizing that singular must use Persian ها / ان (not the Arabic form).
     *
     * @return string[][]
     */
    public static function dataMixedPluralShouldBeConvertedToSingular(): array
    {
        return [
            ['اماکن', 'مکان'],
            ['کتب', 'کتاب'],
            ['علوم', 'علم'],
            ['اخبار', 'خبر'],
            ['اولاد', 'ولد'],
            ['اساتید', 'استاد'],
            ['امور', 'امر'],
            ['افراد', 'فرد'],
            ['اطفال', 'طفل'],
            ['حروف', 'حرف'],
            ['مدارس', 'مدرسه'],
            ['مساجد', 'مسجد'],
            ['مکاتب', 'مکتب'],
            ['جبال', 'جبل'],
            ['قلوب', 'قلب'],
            ['دروس', 'درس'],
            ['ظروف', 'ظرف'],
            ['آثار', 'اثر'],
            ['اعداد', 'عدد'],
            ['اشیا', 'شیء'],
            ['اشخاص', 'شخص'],
            ['ادیان', 'دین'],
            ['ابیات', 'بیت'],
            ['علما', 'عالم'],
            ['ادبا', 'ادیب'],
            ['غربا', 'غریب'],
            ['رجال', 'رجل'],
            ['مجالس', 'مجلس'],
            ['منازل', 'منزل'],
            ['مفاتیح', 'مفتاح'],
            ['بلدان', 'بلد'],
            ['اجسام', 'جسم'],
            ['اعضا', 'عضو'],
            ['اقوال', 'قول'],
            ['الفاظ', 'لفظ'],
            ['رسل', 'رسول'],
            ['صور', 'صورت'],
            ['علل', 'علت'],
            ['ملل', 'ملت'],
            ['شعرا', 'شاعر'],
            ['فقرا', 'فقیر'],
            ['فضلا', 'فاضل'],
            ['افکار', 'فکر'],
            ['اعمال', 'عمل'],
            ['اخلاق', 'خلق'],
            ['مراحل', 'مرحله'],
            ['مذاهب', 'مذهب'],
            ['ائمه', 'امام'],
            ['ادعیه', 'دعا'],
            ['امراض', 'مرض'],
            ['حقوق', 'حق'],
            ['حقایق', 'حقیقت'],
            ['مراکز', 'مرکز'],
            ['میادین', 'میدان'],
            ['فرامین', 'فرمان'],
            ['بنادر', 'بندر'],
            ['حیوانات', 'حیوان'],
            ['محصولات', 'محصول'],
            ['امکانات', 'امکان'],
            ['تشکیلات', 'تشکیل'],
            ['اطلاعات', 'اطلاع'],
            ['تجربیات', 'تجربه'],
        ];
    }

    /** @dataProvider dataMixedPluralShouldBeConvertedToSingular */
    #[DataProvider('dataMixedPluralShouldBeConvertedToSingular')]
    public function testMixedPluralShouldBeConvertedToSingular(string $mixedPlural, string $singular): void
    {
        self::assertSame(
            $singular,
            $this->createInflector()->singularize($mixedPlural),
            sprintf("'%s' should be singularized to '%s' because it is a mixed plural", $mixedPlural, $singular)
        );
        self::assertNotSame(
            $mixedPlural,
            $this->createInflector()->pluralize($singular),
            sprintf("'%s' should not be pluralized to '%s' because Persian plurals are preferred", $singular, $mixedPlural)
        );
    }

    /**
     * Plurals written with a regular space before ها should still singularize.
     *
     * @return string[][]
     */
    public static function dataSpaceSeparatedHa(): array
    {
        return [
            ['کتاب ها', 'کتاب'],
            ['خانه ها', 'خانه'],
            ['ماشین ها', 'ماشین'],
            ['گربه ها', 'گربه'],
        ];
    }

    /** @dataProvider dataSpaceSeparatedHa */
    #[DataProvider('dataSpaceSeparatedHa')]
    public function testSpaceSeparatedHaSingularizes(string $plural, string $singular): void
    {
        self::assertSame(
            $singular,
            $this->createInflector()->singularize($plural),
            sprintf("'%s' should be singularized to '%s'", $plural, $singular)
        );
    }

    /**
     * Literary plurals should singularize even when pluralize prefers ها.
     *
     * @return string[][]
     */
    public static function dataLiteraryPluralSingularizes(): array
    {
        return [
            ['ستارگان', 'ستاره'],
            ['بچگان', 'بچه'],
            ['بندگان', 'بنده'],
            ['فرشتگان', 'فرشته'],
            ['همسایگان', 'همسایه'],
            ['رفتگان', 'رفته'],
            ['زندگان', 'زنده'],
            ['چشمان', 'چشم'],
            ['سخنان', 'سخن'],
            ['دستان', 'دست'],
            ['نویسندگان', 'نویسنده'],
        ];
    }

    /** @dataProvider dataLiteraryPluralSingularizes */
    #[DataProvider('dataLiteraryPluralSingularizes')]
    public function testLiteraryPluralSingularizes(string $plural, string $singular): void
    {
        self::assertSame(
            $singular,
            $this->createInflector()->singularize($plural),
            sprintf("'%s' should be singularized to '%s'", $plural, $singular)
        );
    }

    /**
     * Words without a distinct plural form.
     *
     * @return string[][]
     */
    public static function dataPluralUninflectedWhenPluralized(): array
    {
        return [
            ['مردم'],
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

    /**
     * Singular nouns that end in ان / گان / ها must not be mangled by singularize.
     *
     * @return string[][]
     */
    public static function dataSingularsThatMustNotBeMangled(): array
    {
        return [
            // end in ان but are not plurals
            ['مکان'],
            ['زمان'],
            ['زبان'],
            ['ایران'],
            ['نان'],
            ['جان'],
            ['عنوان'],
            ['امکان'],
            ['ایمان'],
            // place names that look like گان / ان plurals
            ['گرگان'],
            ['زاهدان'],
            ['گیلان'],
            ['تهران'],
            // end in ها but are not plurals
            ['تنها'],
            ['رها'],
        ];
    }

    /** @dataProvider dataSingularsThatMustNotBeMangled */
    #[DataProvider('dataSingularsThatMustNotBeMangled')]
    public function testSingularsThatMustNotBeMangled(string $singular): void
    {
        self::assertSame(
            $singular,
            $this->createInflector()->singularize($singular),
            sprintf("'%s' should remain unchanged when singularized", $singular)
        );
    }

    /**
     * Silent-ه inanimates must take ها, never ان / گان.
     *
     * @return string[][]
     */
    public static function dataSilentHeInanimatesUseHa(): array
    {
        return [
            ['خانه'],
            ['نامه'],
            ['میوه'],
            ['هفته'],
            ['دسته'],
            ['جامعه'],
            ['مدرسه'],
        ];
    }

    /** @dataProvider dataSilentHeInanimatesUseHa */
    #[DataProvider('dataSilentHeInanimatesUseHa')]
    public function testSilentHeInanimatesUseHa(string $singular): void
    {
        $plural = $this->createInflector()->pluralize($singular);

        self::assertSame(
            $singular . "\u{200C}" . 'ها',
            $plural,
            sprintf("'%s' should pluralize with ZWNJ + ها, not ان/گان", $singular)
        );
        self::assertSame($singular, $this->createInflector()->singularize($plural));
    }

    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::PERSIAN)->build();
    }
}
