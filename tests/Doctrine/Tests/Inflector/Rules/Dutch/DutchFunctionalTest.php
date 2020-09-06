<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\Dutch;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;
use Doctrine\Tests\Inflector\Rules\LanguageFunctionalTest;

class DutchFunctionalTest extends LanguageFunctionalTest
{
    /**
     * @return list<array{string, string}>
     */
    public function dataSampleWords(): array
    {
        return [
            ['aanbod', 'aanbiedingen'],
            ['adres', 'adressen'],
            ['beleg', 'belegeringen'],
            ['dank', 'dankbetuigingen'],
            ['ei', 'eieren'],
            ['epos', 'epen'],
            ['gedrag', 'gedragingen'],
            ['gelid', 'gelederen'],
            ['genius', 'geniën'],
            ['genot', 'genietingen'],
            ['industrie', 'industrieën'],
            ['kalf', 'kalveren'],
            ['koe', 'koeien'],
            ['lam', 'lammeren'],
            ['leerrede', 'leerredenen'],
            ['lende', 'lendenen'],
            ['lid', 'leden'],
            ['lof', 'lofbetuigingen'],
            ['matrices', 'matrix'],
            ['mogelijkheid', 'mogelijkheden'],
            ['olie', 'oliën'],
            ['qaestrices', 'quaestrix'],
            ['rij', 'rijen'],
            ['schip', 'schepen'],
            ['smid', 'smeden'],
            ['stad', 'steden'],
            ['twitter', 'twitter'],
            ['vlo', 'vlooien'],
            ['weerman', 'weermannen'],
        ];
    }

    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::DUTCH)->build();
    }
}
