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
            ['schip', 'schepen'],
            ['stad', 'steden'],
            ['gelid', 'gelederen'],
            // @todo more
            ['weerman', 'weermannen'],
            ['ei', 'eieren'],
            ['rij', 'rijen'],
            ['mogelijkheid', 'mogelijkheden'],
            ['adres', 'adressen'],
            ['olie', 'oliën'],
            ['industrie', 'industrieën'],
            ['lid', 'leden'],
            ['smid', 'smeden'],
            ['kalf', 'kalveren'],
            ['lam', 'lammeren'],
            ['koe', 'koeien'],
            ['vlo', 'vlooien'],
            ['leerrede', 'leerredenen'],
            ['lende', 'lendenen'],
            ['epos', 'epen'],           // @todo: make the multiplitudes arrays w/o sort order as well, epossen
            ['epos', 'epossen'],
            ['genius', 'geniën'],
            ['aanbod', 'aanbiedingen'],
            ['beleg', 'belegeringen'],  // @todo: meening: past to circumvent a camp to concor
            ['beleg', 'beleggen'],      // @todo: meening: present
            ['beleg', 'belegjes'],      // @todo: meening: the slices food on a sandwich
            ['dank', 'dankbetuigingen'],
            ['gedrag', 'gedragingen'],
            ['genot', 'genietingen'],
            ['lof', 'lofbetuigingen'],
            ['qaestrices', 'quaestrix'],
            ['matrices', 'matrix'],
            ['twitter', 'twitter'],
        ];
    }

    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::DUTCH)->build();
    }
}
