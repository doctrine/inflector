<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Portuguese;

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
        yield new Pattern('atlas');
        yield new Pattern('bate-papo');
        yield new Pattern('cais');
        yield new Pattern('fênix');
        yield new Pattern('guarda-chuva');
        yield new Pattern('guarda-roupa');
        yield new Pattern('lápis');
        yield new Pattern('oásis');
        yield new Pattern('ônibus');
        yield new Pattern('ônus');
        yield new Pattern('pára-brisa');
        yield new Pattern('pára-choque');
        yield new Pattern('pires');
        yield new Pattern('porta-malas');
        yield new Pattern('porta-voz');
        yield new Pattern('sem-terra');
        yield new Pattern('tênis');
        yield new Pattern('tórax');
        yield new Pattern('vírus');
    }
}
