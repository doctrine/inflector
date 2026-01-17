<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Swedish;

use Doctrine\Inflector\Rules\Pattern;

final class Uninflected
{
    /** @return Pattern[] */
    public static function getSingular(): iterable
    {
        yield from self::getDefault();
    }

    /** @return Pattern[] */
    public static function getPlural(): iterable
    {
        yield from self::getDefault();
    }

    /** @return Pattern[] */
    private static function getDefault(): iterable
    {
        yield new Pattern('barn');
        yield new Pattern('bröd');
        yield new Pattern('djur');
        yield new Pattern('folk');
        yield new Pattern('får');
        yield new Pattern('hus');
        yield new Pattern('kaffe');
        yield new Pattern('namn');
        yield new Pattern('ord');
        yield new Pattern('rum');
        yield new Pattern('träd');
        yield new Pattern('vatten');
        yield new Pattern('ägg');
    }
}
