<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Plural;
use Doctrine\Inflector\Rules\Rule;
use Doctrine\Inflector\Rules\Word;
use Generator;
use PHPUnit\Framework\TestCase;
use function is_array;
use function iterator_to_array;

class PluralTest extends TestCase
{
    public function testGetDefaultRules() : void
    {
        $defaultRules = Plural::getDefaultRules();

        self::assertInstanceOf(Generator::class, $defaultRules);

        $defaultRulesArray = is_array($defaultRules) ? $defaultRules : iterator_to_array($defaultRules, false);

        self::assertInstanceOf(Rule::class, $defaultRulesArray[0]);
    }

    public function testGetUninflectedWords() : void
    {
        $uninflectedWords = Plural::getUninflectedWords();

        self::assertInstanceOf(Generator::class, $uninflectedWords);

        $uninflectedWordsArray = is_array($uninflectedWords) ? $uninflectedWords : iterator_to_array($uninflectedWords, false);

        self::assertInstanceOf(Word::class, $uninflectedWordsArray[0]);
    }

    public function testGetIrregularRules() : void
    {
        $irregularRules = Plural::getIrregularRules();

        self::assertInstanceOf(Generator::class, $irregularRules);

        $irregularRulesArray = is_array($irregularRules) ? $irregularRules : iterator_to_array($irregularRules, false);

        self::assertInstanceOf(Rule::class, $irregularRulesArray[0]);
    }
}
