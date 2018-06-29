<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules\Spanish;

use Doctrine\Inflector\CachedWordInflector;
use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\Rules\Spanish;
use Doctrine\Inflector\RulesetInflector;
use Doctrine\Tests\Inflector\Rules\LanguageFunctionalTest;

class SpanishFunctionalTest extends LanguageFunctionalTest
{
    /**
     * @return string[][]
     */
    public function dataSampleWords() : array
    {
        return [
            ['libro', 'libros'],
            ['pluma', 'plumas'],
            ['chico', 'chicos'],
            ['señora', 'señoras'],
            ['radio', 'radios'],
            ['borrador', 'borradores'],
            ['universidad', 'universidades'],
            ['profesor', 'profesores'],
            ['ciudad', 'ciudades'],
            ['señor', 'señores'],
            ['escultor', 'escultores'],
            ['sociedad', 'sociedades'],
            ['azul', 'azules'],
            ['mes', 'meses'],
            ['avión', 'aviones'],
            ['conversación', 'conversaciones'],
            ['sección', 'secciones'],
            ['televisión', 'televisiones'],
            ['interés', 'intereses'],
            ['lápiz', 'lápices'],
            ['voz', 'voces'],
            ['tapiz', 'tapices'],
            ['actriz', 'actrices'],
            ['luz', 'luces'],
            ['mez', 'meces'],
            ['tisú', 'tisúes'],
            ['hindú', 'hindúes'],
            ['ley', 'leyes'],
            ['café', 'cafés'],
            ['el', 'los'],
            ['lunes', 'lunes'],
            ['rompecabezas', 'rompecabezas'],
            ['crisis', 'crisis'],
            ['papá', 'papás'],
            ['mamá', 'mamás'],
            ['sofá', 'sofás'],
        ];
    }

    protected function createInflector() : Inflector
    {
        return new Inflector(
            new CachedWordInflector(new RulesetInflector(
                Spanish\Rules::getSingularRuleset()
            )),
            new CachedWordInflector(new RulesetInflector(
                Spanish\Rules::getPluralRuleset()
            ))
        );
    }
}
