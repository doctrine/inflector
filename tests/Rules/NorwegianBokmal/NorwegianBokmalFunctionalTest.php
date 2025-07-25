<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\NorwegianBokmal;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;
use Doctrine\Tests\Inflector\Rules\LanguageFunctionalTestCase;

class NorwegianBokmalFunctionalTest extends LanguageFunctionalTestCase
{
    /** @return string[][] */
    public static function dataSampleWords(): array
    {
        return [
            ['dag', 'dager'],
            ['fjord', 'fjorder'],
            ['hund', 'hunder'],
            ['kalender', 'kalendere'],
            ['katt' , 'katter'],
            ['lærer', 'lærere'],
            ['test', 'tester'],
            ['konto', 'konti'],
            ['barn', 'barn'],
            ['fjell', 'fjell'],
            ['hus', 'hus'],
        ];
    }

    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::NORWEGIAN_BOKMAL)->build();
    }
}
