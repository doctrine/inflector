<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

class Singular
{
    /**
     * @return Rule[]
     */
    public static function getDefaultRules() : iterable
    {
        yield new Rule('/(s)tatuses$/i', '\1\2tatus');
        yield new Rule('/^(.*)(menu)s$/i', '\1\2');
        yield new Rule('/(quiz)zes$/i', '\\1');
        yield new Rule('/(matr)ices$/i', '\1ix');
        yield new Rule('/(vert|ind)ices$/i', '\1ex');
        yield new Rule('/^(ox)en/i', '\1');
        yield new Rule('/(alias)(es)*$/i', '\1');
        yield new Rule('/(buffal|her|potat|tomat|volcan)oes$/i', '\1o');
        yield new Rule('/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|viri?)i$/i', '\1us');
        yield new Rule('/([ftw]ax)es/i', '\1');
        yield new Rule('/(analys|ax|cris|test|thes)es$/i', '\1is');
        yield new Rule('/(shoe|slave)s$/i', '\1');
        yield new Rule('/(o)es$/i', '\1');
        yield new Rule('/ouses$/', 'ouse');
        yield new Rule('/([^a])uses$/', '\1us');
        yield new Rule('/([m|l])ice$/i', '\1ouse');
        yield new Rule('/(x|ch|ss|sh)es$/i', '\1');
        yield new Rule('/(m)ovies$/i', '\1\2ovie');
        yield new Rule('/(s)eries$/i', '\1\2eries');
        yield new Rule('/([^aeiouy]|qu)ies$/i', '\1y');
        yield new Rule('/([lr])ves$/i', '\1f');
        yield new Rule('/(tive)s$/i', '\1');
        yield new Rule('/(hive)s$/i', '\1');
        yield new Rule('/(drive)s$/i', '\1');
        yield new Rule('/(dive)s$/i', '\1');
        yield new Rule('/(olive)s$/i', '\1');
        yield new Rule('/([^fo])ves$/i', '\1fe');
        yield new Rule('/(^analy)ses$/i', '\1sis');
        yield new Rule('/(analy|diagno|^ba|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i', '\1\2sis');
        yield new Rule('/(tax)a$/i', '\1on');
        yield new Rule('/(c)riteria$/i', '\1riterion');
        yield new Rule('/([ti])a$/i', '\1um');
        yield new Rule('/(p)eople$/i', '\1\2erson');
        yield new Rule('/(m)en$/i', '\1an');
        yield new Rule('/(c)hildren$/i', '\1\2hild');
        yield new Rule('/(f)eet$/i', '\1oot');
        yield new Rule('/(n)ews$/i', '\1\2ews');
        yield new Rule('/eaus$/', 'eau');
        yield new Rule('/^(.*us)$/', '\\1');
        yield new Rule('/s$/i', '');
    }

    /**
     * @return Word[]
     */
    public static function getUninflectedWords() : iterable
    {
        yield new Word('.*[nrlm]ese');
        yield new Word('.*deer');
        yield new Word('.*fish');
        yield new Word('.*measles');
        yield new Word('.*ois');
        yield new Word('.*pox');
        yield new Word('.*sheep');
        yield new Word('.*ss');
        yield new Word('data');
        yield new Word('police');
        yield new Word('pants');
        yield new Word('clothes');
    }

    /**
     * @return Rule[]
     */
    public static function getIrregularRules() : iterable
    {
        yield new Rule('abuses', 'abuse');
        yield new Rule('avalanches', 'avalanche');
        yield new Rule('caches', 'cache');
        yield new Rule('criteria', 'criterion');
        yield new Rule('curves', 'curve');
        yield new Rule('emphases', 'emphasis');
        yield new Rule('foes', 'foe');
        yield new Rule('geese', 'goose');
        yield new Rule('graves', 'grave');
        yield new Rule('hoaxes', 'hoax');
        yield new Rule('media', 'medium');
        yield new Rule('neuroses', 'neurosis');
        yield new Rule('saves', 'save');
        yield new Rule('waves', 'wave');
        yield new Rule('oases', 'oasis');
        yield new Rule('valves', 'valve');
    }
}
