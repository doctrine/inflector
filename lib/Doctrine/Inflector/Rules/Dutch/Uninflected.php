<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Dutch;

use Doctrine\Inflector\Rules\Pattern;

final class Uninflected
{
    /**
     * @return Pattern[]
     */
    public static function getSingular() : iterable
    {
        yield from self::getDefault();

        // http://nl.wikipedia.org/wiki/Plurale_tantum
        yield new Pattern('hersenen');
        yield new Pattern('ingewanden');
        yield new Pattern('mazelen');
        yield new Pattern('pokken');
        yield new Pattern('waterpokken');
        yield new Pattern('financiën');
        yield new Pattern('activa');
        yield new Pattern('passiva');
        yield new Pattern('onkosten');
        yield new Pattern('kosten');
        yield new Pattern('bescheiden');
        yield new Pattern('paperassen');
        yield new Pattern('notulen');
        yield new Pattern('Roma');
        yield new Pattern('Sinti');
        yield new Pattern('Inuit');
        yield new Pattern('taliban');
        yield new Pattern('illuminati');
        yield new Pattern('aanstalten');
        yield new Pattern('hurken');
        yield new Pattern('lurven');
        yield new Pattern('luren');
    }

    /**
     * @return Pattern[]
     */
    public static function getPlural() : iterable
    {
        yield from self::getDefault();

        // http://nl.wikipedia.org/wiki/Singulare_tantum
        yield new Pattern('letterkunde');
        yield new Pattern('muziek');
        yield new Pattern('heelal');
        yield new Pattern('vastgoed');
        yield new Pattern('have');
        yield new Pattern('nageslacht');
    }

    /**
     * @return Pattern[]
     */
    private static function getDefault() : iterable
    {
        yield new Pattern('twitter');
    }
}
