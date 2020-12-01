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
            ['genius', 'geniën'],
            ['aanbod', 'aanbiedingen'],
            ['dank', 'dankbetuigingen'],
            ['gedrag', 'gedragingen'],
            ['genot', 'genietingen'],
            ['lof', 'lofbetuigingen'],
            ['qaestrices', 'quaestrix'],
            ['matrices', 'matrix'],
            ['twitter', 'twitter'],
            // @todo: multiplitudes array w/o sort order for multiple plural same possibilities
            ['epos', 'epen'],
            // ['epos', 'epossen'],
            // @todo: multiplitudes array w/o sort order for multiple plural different meenings
            ['beleg', 'belegeringen'],     // @todo: meening: invest a city and then conquer it
            // ['beleg', 'beleggen'],      // @todo: meening: call a meeting
            // ['beleg', 'belegjes'],      // @todo: meening: the slices food on a sandwich
        ];
    }

    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::DUTCH)->build();
    }
}
