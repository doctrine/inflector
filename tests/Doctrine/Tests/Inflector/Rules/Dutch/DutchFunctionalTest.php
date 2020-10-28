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
     * @return string[][]
     */
    public function dataSampleWords() : array
    {
        return [
            // @todo: ask for not-sort, cause that's them (ssst) sometimes do, if them do and all that
            ['schip', 'schepen'],
            ['stad', 'steden'],
            ['gelid', 'gelederen'],
            ['weerman', 'weermannen'],
            ['ei', 'eieren'],
            ['rij', 'rijen'],
            ['mogelijkheid', 'mogelijkheden'],
            ['adres', 'adressen'],
            ['olie', 'oliën'],
            ['industrie', 'industrieën'],
            ['lid', 'leden'],
            ['smid', 'smeden'],
            ['schip', 'schepen'],
            ['kalf', 'kalveren'],
            ['lam', 'lammeren'],
            ['koe', 'koeien'],
            ['vlo', 'vlooien'],
            ['leerrede', 'leerredenen'],
            ['lende', 'lendenen'],
            ['epos', 'epen'],   // @todo: make the multiplitudes arrays w/o sort order as well, epossen
            ['genius', 'geniën'],
            ['aanbod', 'aanbiedingen'],
            ['beleg', 'belegeringen'],
            ['dank', 'dankbetuigingen'],
            ['gedrag', 'gedragingen'],
            ['genot', 'genietingen'],
            ['lof', 'lofbetuigingen'],
            ['qaestrices', 'quaestrix'],
            ['matrices', 'matrix'],
            ['twitter', 'twitter'],
        ];
    }

    protected function createInflector() : Inflector
    {
        return InflectorFactory::createForLanguage(Language::DUTCH)->build();
    }
}
