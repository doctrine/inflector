<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\French;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;
use Doctrine\Tests\Inflector\Rules\LanguageFunctionalTestCase;

class FrenchFunctionalTest extends LanguageFunctionalTestCase
{
    /** @return string[][] */
    public static function dataSampleWords(): array
    {
        return [
            ['ami', 'amis'],
            ['chien', 'chiens'],
            ['fidèle', 'fidèles'],
            ['rapport', 'rapports'],
            ['sain', 'sains'],
            ['jouet', 'jouets'],
            ['bijou', 'bijoux'],
            ['caillou', 'cailloux'],
            ['chou', 'choux'],
            ['genou', 'genoux'],
            ['hibou', 'hiboux'],
            ['joujou', 'joujoux'],
            ['pou', 'poux'],
            ['gaz', 'gaz'],
            ['tuyau', 'tuyaux'],
            ['nouveau', 'nouveaux'],
            ['aveu', 'aveux'],
            ['bleu', 'bleus'],
            ['émeu', 'émeus'],
            ['landau', 'landaus'],
            ['lieu', 'lieux'],
            ['pneu', 'pneus'],
            ['sarrau', 'sarraus'],
            ['journal', 'journaux'],
            ['local', 'locaux'],
            ['détail', 'détails'],
            ['bail', 'baux'],
            ['corail', 'coraux'],
            ['émail', 'émaux'],
            ['gemmail', 'gemmaux'],
            ['soupirail', 'soupiraux'],
            ['travail', 'travaux'],
            ['vantail', 'vantaux'],
            ['vitrail', 'vitraux'],
            ['monsieur', 'messieurs'],
            ['madame', 'mesdames'],
            ['mademoiselle', 'mesdemoiselles'],
            ['chacal', 'chacals'],
            ['carnaval', 'carnavals'],
            ['festival', 'festivals'],
            ['récital', 'récitals'],
            ['bois', 'bois'],
            ['mas', 'mas'],
        ];
    }

    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::FRENCH)->build();
    }
}
