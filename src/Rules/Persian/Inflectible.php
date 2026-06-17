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

        yield new Transformation(new Pattern('(ه)ان$'), '\1');

        /**
         * It is recommended to use ZWNJ (aka: نیم‌فاصله) instead of space for Persian when concatenating words.
         */
        yield new Transformation(new Pattern(self::ZWNJ . 'ها$'), '');

        /**
         * But we support space, because some people use it.
         */
        yield new Transformation(new Pattern(self::SPACE . 'ها$'), '');
    }

    /**
     * There are some plural words that are irregular in Persian.
     * The source of these words is came from Arabic which is known as mixed plural (جمع مکسر)
     * It is recommended to use Persian rules for these words instead of Arabic rules.
     * So we support to convert them to singular from mixed plural.
     * But when converting to plural, we use the Persian plural rules.
     * So, when you convert these kind of words from singular to plural, you will NOT get the mixed plurals.
     *
     * @return Transformation[]
     */
    public static function getMixedPluralToSingular(): iterable
    {
        yield new Transformation(new Pattern('^اماکن$'), 'مکان');
    }

    /** @return Transformation[] */
    public static function getPlural(): iterable
    {
        /**
         * If a word ends with "ه", we add "ان" to the end of the word.
         * Because adding "ها" to the end of the word will make it difficult to read.
         * Also it will repeat the "ه" sound, like: "گیاه‌ها"
         */
        yield new Transformation(new Pattern('(ه)$'), '\1ان');

        /**
         * Generally, we add "ها" to the end of the word to make it plural.
         */
        yield new Transformation(new Pattern('$'), self::ZWNJ . 'ها');
    }

    /** @return Substitution[] */
    public static function getIrregular(): iterable
    {
        yield new Substitution(new Word(''), new Word(''));
    }
}
