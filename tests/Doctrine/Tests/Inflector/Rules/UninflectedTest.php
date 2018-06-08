<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Rules\Uninflected;
use Doctrine\Inflector\Rules\Word;
use Generator;
use PHPUnit\Framework\TestCase;
use function is_array;
use function iterator_to_array;

class UninflectedTest extends TestCase
{
    /** @var Uninflected */
    private $uninflected;

    public function testGetDefaultWords() : void
    {
        $defaultWords = Uninflected::getDefaultWords();

        self::assertInstanceOf(Generator::class, $defaultWords);

        $defaultWordsArray = is_array($defaultWords) ? $defaultWords : iterator_to_array($defaultWords, false);

        self::assertInstanceOf(Word::class, $defaultWordsArray[0]);
    }

    public function testGetWords() : void
    {
        $words = $this->uninflected->getWords();

        self::assertInstanceOf(Generator::class, $words);

        $wordsArray = is_array($words) ? $words : iterator_to_array($words, false);

        self::assertInstanceOf(Word::class, $wordsArray[0]);
    }

    public function testIsUninflected() : void
    {
        self::assertTrue($this->uninflected->isUninflected('test1'));
        self::assertFalse($this->uninflected->isUninflected('test2'));
    }

    protected function setUp() : void
    {
        $this->uninflected = new Uninflected(new Word('test1'));
    }
}
