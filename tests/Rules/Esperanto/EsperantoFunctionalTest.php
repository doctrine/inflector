<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\Esperanto;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;
use Doctrine\Tests\Inflector\Rules\LanguageFunctionalTestCase;

class EsperantoFunctionalTest extends LanguageFunctionalTestCase
{
    /** @return string[][] */
    public static function dataSampleWords(): array
    {
        return [
            ['abelo', 'abeloj'],
            ['ĉapelo', 'ĉapeloj'],
            ['domo', 'domoj'],
            ['eĥoŝanĝo', 'eĥoŝanĝoj'],
            ['fervojo', 'fervojoj'],
            ['lingvo', 'lingvoj'],
            ['manĝaĵo', 'manĝaĵoj'],
            ['muzikalo', 'muzikaloj'],
            ['terpomo', 'terpomoj'],
            ['vortaro', 'vortaroj'],
        ];
    }

    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::ESPERANTO)->build();
    }
}
