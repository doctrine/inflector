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
            ['idee', 'ideeën'],
            ['stad', 'steden'],
            ['gelid', 'gelederen'],
            // @todo more words
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
            ['quaestrix', 'quaestrices'],
            ['matrix', 'matrices'],
            // @todo: newly added, create exceptions or rules
            // @todo: check next 5 words
            // ['meer', 'meren'],
            // ['baas', 'bazen'],
            // ['oog', 'ogen'],
            // ['as', 'assen'],
            // ['kies', 'kiezen'],
            ['twitter', 'twitter'],
            // @todo: multiplitudes array w/o sort order for multiple plural same possibilities
            ['epos', 'epen'],
            // ['epos', 'epossen'],
            // @todo: multiplitudes array w/o sort order for multiple plural different meanings
            ['beleg', 'belegeringen'],     // @todo: meaning: invest a city and then conquer it
            // ['beleg', 'beleggen'],      // @todo: meaning: call a meeting
            // ['beleg', 'belegjes'],      // @todo: meaning: the slices food on a sandwich
        ];
    }

    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::DUTCH)->build();
    }
}
