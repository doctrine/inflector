<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Dictionary\English;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Word;

class Uninflected
{
    /**
     * @return Word[]|Pattern[]
     */
    private static function default() : iterable
    {
        yield new Pattern('.*[nrlm]ese');
        yield new Pattern('.*deer');
        yield new Pattern('.*fish');
        yield new Pattern('.*measles');
        yield new Pattern('.*ois');
        yield new Pattern('.*pox');
        yield new Pattern('.*sheep');
        yield new Word('police');
    }

    /**
     * @return Word[]|Pattern[]
     */
    public static function singular() : iterable
    {
        yield from self::default();

        yield new Pattern('.*ss');
        yield new Word('data');
        yield new Word('pants');
        yield new Word('clothes');
    }

    /**
     * @return Word[]|Pattern[]
     */
    public static function plural() : iterable
    {
        yield from self::default();

        yield new Word('people');
        yield new Word('middleware');
    }
}
