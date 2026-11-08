<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Persian;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Transformation;
use Doctrine\Inflector\Rules\Word;

class Inflectible
{
    /**
     * @see https://en.wikipedia.org/wiki/Zero-width_non-joiner
     * @see https://unicode-table.com/en/200C/
     */
    public const ZWNJ = "\u{200C}";

    public const SPACE = ' ';

    /** @return Transformation[] */
    public static function getSingular(): iterable
    {
        yield from self::getMixedPluralToSingular();
        yield from self::getLiteraryPluralToSingular();

        /**
         * Prefer ZWNJ (نیم‌فاصله) before ها in Persian orthography.
         * Also accept a regular space. Bare ها is not stripped: words such as
         * تنها and رها end with those letters but are not plurals.
         */
        yield new Transformation(new Pattern('/' . self::ZWNJ . 'ها$/u'), '');
        yield new Transformation(new Pattern('/' . self::SPACE . 'ها$/u'), '');
    }

    /**
     * Arabic broken plurals (جمع مکسر) borrowed into Persian.
     *
     * Recognized only when singularizing. Pluralizing always prefers
     * Persian suffixes (ها / ان) rather than regenerating the Arabic form.
     *
     * @return Transformation[]
     */
    public static function getMixedPluralToSingular(): iterable
    {
        // Exact pairs: a blanket suffix rule would corrupt stems such as مکان / زمان.
        $pairs = [
            'اماکن' => 'مکان',
            'کتب' => 'کتاب',
            'علوم' => 'علم',
            'اخبار' => 'خبر',
            'اولاد' => 'ولد',
            'اساتید' => 'استاد',
            'امور' => 'امر',
            'افراد' => 'فرد',
            'اطفال' => 'طفل',
            'حروف' => 'حرف',
            'مدارس' => 'مدرسه',
            'مساجد' => 'مسجد',
            'مکاتب' => 'مکتب',
            'جبال' => 'جبل',
            'قلوب' => 'قلب',
            'دروس' => 'درس',
            'ظروف' => 'ظرف',
            'آثار' => 'اثر',
            'اعداد' => 'عدد',
            'اشیا' => 'شیء',
            'اشخاص' => 'شخص',
            'ادیان' => 'دین',
            'ابیات' => 'بیت',
            'علما' => 'عالم',
            'ادبا' => 'ادیب',
            'غربا' => 'غریب',
            'رجال' => 'رجل',
            'مجالس' => 'مجلس',
            'منازل' => 'منزل',
            'مفاتیح' => 'مفتاح',
            'بلدان' => 'بلد',
            'اجسام' => 'جسم',
            'اعضا' => 'عضو',
            'اقوال' => 'قول',
            'الفاظ' => 'لفظ',
            'رسل' => 'رسول',
            'صور' => 'صورت',
            'علل' => 'علت',
            'ملل' => 'ملت',
            'شعرا' => 'شاعر',
            'فقرا' => 'فقیر',
            'فضلا' => 'فاضل',
            'افکار' => 'فکر',
            'اعمال' => 'عمل',
            'اخلاق' => 'خلق',
            'مراحل' => 'مرحله',
            'مذاهب' => 'مذهب',
            'ائمه' => 'امام',
            'ادعیه' => 'دعا',
            'امراض' => 'مرض',
            'حقوق' => 'حق',
            'حقایق' => 'حقیقت',
            'مراکز' => 'مرکز',
            'میادین' => 'میدان',
            'فرامین' => 'فرمان',
            'بنادر' => 'بندر',
            'حیوانات' => 'حیوان',
            'محصولات' => 'محصول',
            'امکانات' => 'امکان',
            'تشکیلات' => 'تشکیل',
            'اطلاعات' => 'اطلاع',
            'تجربیات' => 'تجربه',
        ];

        foreach ($pairs as $plural => $singular) {
            yield new Transformation(new Pattern('/^' . $plural . '$/u'), $singular);
        }
    }

    /**
     * Literary Persian plurals (گان / ان on inanimates) that should singularize,
     * even when pluralize prefers the everyday ها form.
     *
     * Exact matches only: a bare گان$ rule would corrupt place names such as گرگان.
     *
     * @return Transformation[]
     */
    public static function getLiteraryPluralToSingular(): iterable
    {
        $pairs = [
            'ستارگان' => 'ستاره',
            'بچگان' => 'بچه',
            'بندگان' => 'بنده',
            'فرشتگان' => 'فرشته',
            'همسایگان' => 'همسایه',
            'رفتگان' => 'رفته',
            'زندگان' => 'زنده',
            'چشمان' => 'چشم',
            'سخنان' => 'سخن',
            'دستان' => 'دست',
        ];

        foreach ($pairs as $plural => $singular) {
            yield new Transformation(new Pattern('/^' . $plural . '$/u'), $singular);
        }
    }

    /** @return Transformation[] */
    public static function getPlural(): iterable
    {
        // Universal productive plural: noun + ZWNJ + ها
        yield new Transformation(new Pattern('/$/u'), self::ZWNJ . 'ها');
    }

    /**
     * Formal / literary animate plurals with ان / گان / یان.
     * These cannot be inferred from spelling alone (خانه vs پادشاه both end in ه),
     * so they are listed explicitly. Default pluralization uses ها.
     *
     * @return Substitution[]
     */
    public static function getIrregular(): iterable
    {
        $pairs = [
            // اه + ان (pronounced ه)
            'پادشاه' => 'پادشاهان',
            'گیاه' => 'گیاهان',
            'گواه' => 'گواهان',
            'گناه' => 'گناهان',
            'شاه' => 'شاهان',
            // consonant + ان
            'مرد' => 'مردان',
            'زن' => 'زنان',
            'دوست' => 'دوستان',
            'استاد' => 'استادان',
            'کودک' => 'کودکان',
            'بزرگ' => 'بزرگان',
            'دختر' => 'دختران',
            'پسر' => 'پسران',
            'برادر' => 'برادران',
            'خواهر' => 'خواهران',
            'معلم' => 'معلمان',
            'کارمند' => 'کارمندان',
            'سرباز' => 'سربازان',
            'هنرمند' => 'هنرمندان',
            'دانشمند' => 'دانشمندان',
            'وزیر' => 'وزیران',
            'جانور' => 'جانوران',
            'عزیز' => 'عزیزان',
            // silent ه → گان
            'نویسنده' => 'نویسندگان',
            'پرنده' => 'پرندگان',
            'همسایه' => 'همسایگان',
            'بنده' => 'بندگان',
            'فرشته' => 'فرشتگان',
            // vowel + یان
            'دانشجو' => 'دانشجویان',
            'آقا' => 'آقایان',
            'دانا' => 'دانایان',
            'سخنگو' => 'سخنگویان',
            'آشنا' => 'آشنایان',
            'ایرانی' => 'ایرانیان',
        ];

        foreach ($pairs as $singular => $plural) {
            yield new Substitution(new Word($singular), new Word($plural));
        }
    }
}
