<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Italian;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Transformation;
use Doctrine\Inflector\Rules\Word;

class Inflectible
{
    /**
     * @return Transformation[]
     */
    public static function getSingular() : iterable
    {
        yield new Transformation(new Pattern('e$'), 'a');
        yield new Transformation(new Pattern('i$'), 'e');
        yield new Transformation(new Pattern('i$'), 'o');
    }

    /**
     * @return Transformation[]
     */
    public static function getPlural() : iterable
    {
        yield new Transformation(new Pattern('a$'), 'e');
        yield new Transformation(new Pattern('e$'), 'i');
        yield new Transformation(new Pattern('io$'), 'i');
        yield new Transformation(new Pattern('o$'), 'i');
    }

    /**
     * @return Substitution[]
     */
    public static function getIrregular() : iterable
    {
       return yield new Substitution(new Word(''), new Word(''));
       // yield new Substitution(new Word('studente'), new Word('studenti'));
        //yield new Substitution(new Word('negozio'), new Word('negozi'));
    }
}
