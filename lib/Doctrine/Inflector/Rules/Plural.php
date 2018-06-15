<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

class Plural
{
    /**
     * @return Rule[]
     */
    public static function getDefaultRules() : iterable
    {
        yield new Rule('/(s)tatus$/i', '\1\2tatuses');
        yield new Rule('/(quiz)$/i', '\1zes');
        yield new Rule('/^(ox)$/i', '\1\2en');
        yield new Rule('/([m|l])ouse$/i', '\1ice');
        yield new Rule('/(matr|vert|ind)(ix|ex)$/i', '\1ices');
        yield new Rule('/(x|ch|ss|sh)$/i', '\1es');
        yield new Rule('/([^aeiouy]|qu)y$/i', '\1ies');
        yield new Rule('/(hive|gulf)$/i', '\1s');
        yield new Rule('/(?:([^f])fe|([lr])f)$/i', '\1\2ves');
        yield new Rule('/sis$/i', 'ses');
        yield new Rule('/([ti])um$/i', '\1a');
        yield new Rule('/(tax)on$/i', '\1a');
        yield new Rule('/(c)riterion$/i', '\1riteria');
        yield new Rule('/(p)erson$/i', '\1eople');
        yield new Rule('/(m)an$/i', '\1en');
        yield new Rule('/(c)hild$/i', '\1hildren');
        yield new Rule('/(f)oot$/i', '\1eet');
        yield new Rule('/(buffal|her|potat|tomat|volcan)o$/i', '\1\2oes');
        yield new Rule('/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|vir)us$/i', '\1i');
        yield new Rule('/us$/i', 'uses');
        yield new Rule('/(alias)$/i', '\1es');
        yield new Rule('/(analys|ax|cris|test|thes)is$/i', '\1es');
        yield new Rule('/s$/', 's');
        yield new Rule('/^$/', '');
        yield new Rule('/$/', 's');
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
        yield new Word('people');
        yield new Word('police');
        yield new Word('middleware');
    }

    /**
     * @return Rule[]
     */
    public static function getIrregularRules() : iterable
    {
        yield new Rule('atlas', 'atlases');
        yield new Rule('axe', 'axes');
        yield new Rule('beef', 'beefs');
        yield new Rule('brother', 'brothers');
        yield new Rule('cafe', 'cafes');
        yield new Rule('chateau', 'chateaux');
        yield new Rule('niveau', 'niveaux');
        yield new Rule('child', 'children');
        yield new Rule('cookie', 'cookies');
        yield new Rule('corpus', 'corpuses');
        yield new Rule('cow', 'cows');
        yield new Rule('criterion', 'criteria');
        yield new Rule('curriculum', 'curricula');
        yield new Rule('demo', 'demos');
        yield new Rule('domino', 'dominoes');
        yield new Rule('echo', 'echoes');
        yield new Rule('foot', 'feet');
        yield new Rule('fungus', 'fungi');
        yield new Rule('ganglion', 'ganglions');
        yield new Rule('genie', 'genies');
        yield new Rule('genus', 'genera');
        yield new Rule('goose', 'geese');
        yield new Rule('graffito', 'graffiti');
        yield new Rule('hippopotamus', 'hippopotami');
        yield new Rule('hoof', 'hoofs');
        yield new Rule('human', 'humans');
        yield new Rule('iris', 'irises');
        yield new Rule('larva', 'larvae');
        yield new Rule('leaf', 'leaves');
        yield new Rule('loaf', 'loaves');
        yield new Rule('man', 'men');
        yield new Rule('medium', 'media');
        yield new Rule('memorandum', 'memoranda');
        yield new Rule('money', 'monies');
        yield new Rule('mongoose', 'mongooses');
        yield new Rule('motto', 'mottoes');
        yield new Rule('move', 'moves');
        yield new Rule('mythos', 'mythoi');
        yield new Rule('niche', 'niches');
        yield new Rule('nucleus', 'nuclei');
        yield new Rule('numen', 'numina');
        yield new Rule('occiput', 'occiputs');
        yield new Rule('octopus', 'octopuses');
        yield new Rule('opus', 'opuses');
        yield new Rule('ox', 'oxen');
        yield new Rule('passerby', 'passersby');
        yield new Rule('penis', 'penises');
        yield new Rule('person', 'people');
        yield new Rule('plateau', 'plateaux');
        yield new Rule('runner-up', 'runners-up');
        yield new Rule('safe', 'safes');
        yield new Rule('sex', 'sexes');
        yield new Rule('soliloquy', 'soliloquies');
        yield new Rule('son-in-law', 'sons-in-law');
        yield new Rule('syllabus', 'syllabi');
        yield new Rule('testis', 'testes');
        yield new Rule('thief', 'thieves');
        yield new Rule('tooth', 'teeth');
        yield new Rule('tornado', 'tornadoes');
        yield new Rule('trilby', 'trilbys');
        yield new Rule('turf', 'turfs');
        yield new Rule('valve', 'valves');
        yield new Rule('volcano', 'volcanoes');
    }
}
