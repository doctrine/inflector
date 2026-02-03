<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\Swedish;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;
use Doctrine\Tests\Inflector\Rules\LanguageFunctionalTestCase;
use Override;

class SwedishFunctionalTest extends LanguageFunctionalTestCase
{
    /** @return string[][] */
    #[Override]
    public static function dataSampleWords(): array
    {
        return [
            ['and', 'änder'],
            ['barn', 'barn'],
            ['bil', 'bilar'],
            ['bok', 'böcker'],
            ['bror', 'bröder'],
            ['cykel', 'cyklar'],
            ['dag', 'dagar'],
            ['direktör', 'direktörer'],
            ['djur', 'djur'],
            ['dotter', 'döttrar'],
            ['faktor', 'faktorer'],
            ['faktura', 'fakturor'],
            ['familj', 'familjer'],
            ['far', 'fäder'],
            ['finger', 'fingrar'],
            ['flicka', 'flickor'],
            ['folk', 'folk'],
            ['fot', 'fötter'],
            ['får', 'får'],
            ['gata', 'gator'],
            ['gås', 'gäss'],
            ['hand', 'händer'],
            ['hus', 'hus'],
            ['ingenjör', 'ingenjörer'],
            ['instruktör', 'instruktörer'],
            ['kaffe', 'kaffe'],
            ['kategori', 'kategorier'],
            ['ko', 'kor'],
            ['krona', 'kronor'],
            ['kvinna', 'kvinnor'],
            ['land', 'länder'],
            ['lektion', 'lektioner'],
            ['man', 'män'],
            ['militär', 'militärer'],
            ['mor', 'mödrar'],
            ['motor', 'motorer'],
            ['museum', 'museer'],
            ['mus', 'möss'],
            ['månad', 'månader'],
            ['namn', 'namn'],
            ['nota', 'notor'],
            ['pojke', 'pojkar'],
            ['privat', 'privater'],
            ['prinsessa', 'prinsessor'],
            ['professor', 'professorer'],
            ['region', 'regioner'],
            ['regering', 'regeringar'],
            ['rot', 'rötter'],
            ['rum', 'rum'],
            ['sekreterär', 'sekreterärer'],
            ['serie', 'serier'],
            ['son', 'söner'],
            ['stad', 'städer'],
            ['stol', 'stolar'],
            ['strand', 'stränder'],
            ['studie', 'studier'],
            ['tand', 'tänder'],
            ['tidning', 'tidningar'],
            ['timme', 'timmar'],
            ['träd', 'träd'],
            ['tå', 'tår'],
            ['vara', 'varor'],
            ['vatten', 'vatten'],
            ['vecka', 'veckor'],
            ['överraskning', 'överraskningar'],
            ['öga', 'ögon'],
            ['öra', 'öron'],
        ];
    }

    #[Override]
    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::SWEDISH)->build();
    }
}
