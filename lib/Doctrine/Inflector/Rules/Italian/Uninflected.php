<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Italian;

use Doctrine\Inflector\Rules\Pattern;

final class Uninflected
{
    /**
     * @return Pattern[]
     */
    public static function getSingular() : iterable
    {
        yield from self::getDefault();
    }

    /**
     * @return Pattern[]
     */
    public static function getPlural() : iterable
    {
        yield from self::getDefault();
    }

    /**
     * @return Pattern[]
     */
    private static function getDefault() : iterable
    {
        yield new Pattern('alpaca');
        yield new Pattern('blu');
        yield new Pattern('crocevia');
        yield new Pattern('foto');
        yield new Pattern('fuchsia');
        yield new Pattern('gnu');
        yield new Pattern('gru');
        yield new Pattern('iguana');
        yield new Pattern('koala');
        yield new Pattern('lama');
        yield new Pattern('moto');
        yield new Pattern('opossum');
        yield new Pattern('panda');
        yield new Pattern('radio');
        yield new Pattern('scacciapensieri');
    }
}
