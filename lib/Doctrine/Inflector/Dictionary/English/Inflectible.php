<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Dictionary\English;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Regex;
use Doctrine\Inflector\Rules\Transformation;
use Doctrine\Inflector\Rules\Word;
use Doctrine\Inflector\Rules\Substitution;

class Inflectible
{
    /**
     * @return Substitution[]|Regex[]
     */
    public static function all() : iterable
    {
        yield from self::irregular();
        yield from self::regular();
    }

    /**
     * @return Substitution[]|Regex[]
     */
    public static function irregular() : iterable
    {
        yield new Substitution(new Word('belief'), new Word('beliefs'));
        yield new Substitution(new Word('halo'), new Word('halos'));
        yield new Substitution(new Word('photo'), new Word('photos'));
        yield new Substitution(new Word('piano'), new Word('pianos'));
        yield new Substitution(new Word('roof'), new Word('roofs'));
        yield new Transformation(
            new Regex(new Pattern('~chi?ef~i'), '\0s'),
            new Regex(new Pattern('~(chi?ef)s~i'), '\1')
        );
        yield new Substitution(new Word('wife'), new Word('wives'));
        yield new Substitution(new Word('wolf'), new Word('wolves'));
    }

    /**
     * @return Substitution[]|Regex[]
     */
    private static function regular() : iterable
    {
        yield new Transformation(
            new Regex(new Pattern('~on$~i'), 'a'),
            new Regex(new Pattern('~a$~i'), 'on')
        );
        yield new Transformation(
            new Regex(new Pattern('~us$~i'), 'i'),
            new Regex(new Pattern('~i$~i'), 'us')
        );
        yield new Transformation(
            new Regex(new Pattern('~o$~i'), 'oes'),
            new Regex(new Pattern('~oes$~i'), 'oe')
        );
        yield new Transformation(
            new Regex(new Pattern('~is$~i'), 'es'),
            new Regex(new Pattern('~es$~i'), 'is')
        );
        yield new Transformation(
            new Regex(new Pattern('~[bcdfghjklmnpqrstvwxz]y$~i'), '\0s'),
            new Regex(new Pattern('~([bcdfghjklmnpqrstvwxz]y)s~i'), '\1')
        );
        yield new Transformation(
            new Regex(new Pattern('~fe?$~i'), 'ves'),
            new Regex(new Pattern('~ves$~i'), 'f')
        );
        yield new Transformation(
            new Regex(new Pattern('~(s[sh]?|ch|[xz])$~i'), '\1es'),
            new Regex(new Pattern('~(s[sh]?|ch|[xz])es$~i'), '\1')
        );
        yield new Transformation(
            new Regex(new Pattern('/$/'), 's'),
            new Regex(new Pattern('/s$/i'), '')
        );
    }
}
