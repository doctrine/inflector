<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\Italian;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;
use Doctrine\Tests\Inflector\Rules\LanguageFunctionalTestCase;

class ItalianFunctionalTest extends LanguageFunctionalTestCase
{
    /** @return string[][] */
    public static function dataSampleWords(): array
    {
        return [
            // Empty string and edge cases
            ['', ''],
            [' ', ' '],
            ['123', '123'],
            ['@#!', '@#!'],

            // Invariable nouns (same in singular and plural)
            ['re', 're'],
            ['città', 'città'],
            ['virtù', 'virtù'],
            ['specie', 'specie'],
            ['serie', 'serie'],
            ['crisi', 'crisi'],
            ['superficie', 'superfici'],
            ['metropoli', 'metropoli'],

            // Foreign words and loanwords
            ['film', 'film'],
            ['sport', 'sport'],
            ['bar', 'bar'],
            ['computer', 'computer'],
            ['menu', 'menu'],
            ['taxi', 'taxi'],
            ['quiz', 'quiz'],
            ['smartphone', 'smartphone'],
            ['tablet', 'tablet'],
            ['virus', 'virus'],
            ['campus', 'campus'],

            // Abbreviations and shortened forms
            ['foto', 'foto'],  // from fotografia
            ['moto', 'moto'],  // from motocicletta
            ['auto', 'auto'],  // from automobile

            // Words with accented vowels
            ['caffè', 'caffè'],
            ['tè', 'tè'],
            ['menù', 'menù'],

            // Compound words
            ['dopocena', 'dopocena'],
            ['sottoscala', 'sottoscala'],

            // Nouns with irregular patterns
            ['tempio', 'templi'],
            ['ala', 'ali'],
            ['mano', 'mani'],

            // Words with multiple plural forms
            ['braccio', 'braccia'],  // arm -> arms
            ['ginocchio', 'ginocchia'],  // body part
            ['dito', 'dita'],  // more common
            ['baco', 'bachi'],  // more common

            // Words that change meaning in plural
            ['membro', 'membri'],    // members of an organization
            ['membrana', 'membrane'],  // membranes

            // Words with identical forms but different genders/meanings
            ['capitale', 'capitali'],  // capital (money)
            ['capitale', 'capitali'], // capital city (context determines meaning)

            // Irregular plurals and exceptions
            ['uomo', 'uomini'],
            ['dio', 'dei'],
            ['bue', 'buoi'],

            // Nouns ending in -o (masculine)
            ['libro', 'libri'],
            ['tavolo', 'tavoli'],
            ['ragazzo', 'ragazzi'],

            // Nouns ending in -a (feminine)
            ['casa', 'case'],
            ['penna', 'penne'],
            ['amica', 'amiche'],

            // Nouns ending in -e
            ['fiore', 'fiori'],
            ['cane', 'cani'],
            ['chiave', 'chiavi'],

            // Nouns ending in -ca/ga
            ['banca', 'banche'],

            // Nouns ending in -cia/gia
            ['arancia', 'arance'],
            ['valigia', 'valigie'],
            ['camicia', 'camicie'],
            ['fascia', 'fasce'],
            ['farmacia', 'farmacie'],

            // Nouns ending in -co/go
            ['gioco', 'giochi'],
            ['fuoco', 'fuochi'],
            ['albergo', 'alberghi'],

            // Words that are the same in both singular and plural
            ['sosia', 'sosia'],
            ['vaglia', 'vaglia'],
            ['gorilla', 'gorilla'],
            ['yogurt', 'yogurt'],
            ['boomerang', 'boomerang'],
            ['kamikaze', 'kamikaze'],
            ['karaoke', 'karaoke'],
            ['brindisi', 'brindisi'],
            ['boia', 'boia'],
        ];
    }

    protected function createInflector(): Inflector
    {
        return InflectorFactory::createForLanguage(Language::ITALIAN)->build();
    }
}
