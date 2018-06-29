<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\NorwegianBokmal;

use Doctrine\Inflector\CachedWordInflector;
use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\Rules\NorwegianBokmal;
use Doctrine\Inflector\RulesetInflector;
use Doctrine\Tests\Inflector\Rules\LanguageFunctionalTest;

class NorwegianBokmalFunctionalTest extends LanguageFunctionalTest
{
    /**
     * @return string[][]
     */
    public function dataSampleWords() : array
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

    protected function createInflector() : Inflector
    {
        return new Inflector(
            new CachedWordInflector(new RulesetInflector(
                NorwegianBokmal\Rules::getSingularRuleset()
            )),
            new CachedWordInflector(new RulesetInflector(
                NorwegianBokmal\Rules::getPluralRuleset()
            ))
        );
    }
}
