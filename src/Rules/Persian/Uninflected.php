<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Persian;

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
        // Collective / invariant nouns that are not pluralized with ها
        yield new Pattern('مردم');
    }
}
