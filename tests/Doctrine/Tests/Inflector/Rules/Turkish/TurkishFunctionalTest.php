<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\Turkish;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;
use Doctrine\Tests\Inflector\Rules\LanguageFunctionalTest;

class TurkishFunctionalTest extends LanguageFunctionalTest
{
    /**
     * @return string[][]
     */
    public function dataSampleWords(): array
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

    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::TURKISH)->build();
    }
}
