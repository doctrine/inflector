<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\Turkish;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;
use Doctrine\Tests\Inflector\Rules\LanguageFunctionalTestCase;
use Override;

class TurkishFunctionalTest extends LanguageFunctionalTestCase
{
    /** @return string[][] */
    #[Override]
    public static function dataSampleWords(): array
    {
        return [
            ['gün', 'günler'],
            ['kiraz', 'kirazlar'],
            ['kitap', 'kitaplar'],
            ['köpek', 'köpekler'],
            ['test', 'testler'],
            ['üçgen', 'üçgenler'],
            ['ben', 'biz'],
            ['sen', 'siz'],
            ['o', 'onlar'],
        ];
    }

    #[Override]
    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::TURKISH)->build();
    }
}
