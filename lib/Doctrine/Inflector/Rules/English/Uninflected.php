<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\English;

use Doctrine\Inflector\Rules\Pattern;

final class Uninflected
{
    /**
     * @return Pattern[]
     */
    public static function getSingular() : iterable
    {
        yield from self::getDefault();

        yield new Pattern('.*ss');
        yield new Pattern('data');
        yield new Pattern('pants');
        yield new Pattern('clothes');
    }

    /**
     * @return Pattern[]
     */
    public static function getPlural() : iterable
    {
        yield from self::getDefault();

        yield new Pattern('people');
        yield new Pattern('middleware');
    }

    /**
     * @return Pattern[]
     */
    private static function getDefault() : iterable
    {
        yield new Pattern('\w+media');
        yield new Pattern('amoyese');
        yield new Pattern('audio');
        yield new Pattern('bison');
        yield new Pattern('borghese');
        yield new Pattern('bream');
        yield new Pattern('breeches');
        yield new Pattern('britches');
        yield new Pattern('buffalo');
        yield new Pattern('cantus');
        yield new Pattern('carp');
        yield new Pattern('chassis');
        yield new Pattern('clippers');
        yield new Pattern('cod');
        yield new Pattern('coitus');
        yield new Pattern('compensation');
        yield new Pattern('congoese');
        yield new Pattern('contretemps');
        yield new Pattern('coreopsis');
        yield new Pattern('corps');
        yield new Pattern('data');
        yield new Pattern('debris');
        yield new Pattern('deer');
        yield new Pattern('diabetes');
        yield new Pattern('djinn');
        yield new Pattern('education');
        yield new Pattern('eland');
        yield new Pattern('elk');
        yield new Pattern('emoji');
        yield new Pattern('equipment');
        yield new Pattern('evidence');
        yield new Pattern('faroese');
        yield new Pattern('feedback');
        yield new Pattern('fish');
        yield new Pattern('flounder');
        yield new Pattern('foochowese');
        yield new Pattern('furniture');
        yield new Pattern('furniture');
        yield new Pattern('gallows');
        yield new Pattern('genevese');
        yield new Pattern('genoese');
        yield new Pattern('gilbertese');
        yield new Pattern('gold');
        yield new Pattern('headquarters');
        yield new Pattern('herpes');
        yield new Pattern('hijinks');
        yield new Pattern('hottentotese');
        yield new Pattern('information');
        yield new Pattern('innings');
        yield new Pattern('jackanapes');
        yield new Pattern('jedi');
        yield new Pattern('kiplingese');
        yield new Pattern('knowledge');
        yield new Pattern('kongoese');
        yield new Pattern('love');
        yield new Pattern('lucchese');
        yield new Pattern('luggage');
        yield new Pattern('mackerel');
        yield new Pattern('Maltese');
        yield new Pattern('metadata');
        yield new Pattern('mews');
        yield new Pattern('moose');
        yield new Pattern('mumps');
        yield new Pattern('nankingese');
        yield new Pattern('news');
        yield new Pattern('nexus');
        yield new Pattern('niasese');
        yield new Pattern('nutrition');
        yield new Pattern('offspring');
        yield new Pattern('pekingese');
        yield new Pattern('piedmontese');
        yield new Pattern('pincers');
        yield new Pattern('pistoiese');
        yield new Pattern('plankton');
        yield new Pattern('pliers');
        yield new Pattern('pokemon');
        yield new Pattern('police');
        yield new Pattern('portuguese');
        yield new Pattern('proceedings');
        yield new Pattern('rabies');
        yield new Pattern('rain');
        yield new Pattern('rhinoceros');
        yield new Pattern('rice');
        yield new Pattern('salmon');
        yield new Pattern('sarawakese');
        yield new Pattern('scissors');
        yield new Pattern('sea[- ]bass');
        yield new Pattern('series');
        yield new Pattern('shavese');
        yield new Pattern('shears');
        yield new Pattern('sheep');
        yield new Pattern('siemens');
        yield new Pattern('species');
        yield new Pattern('staff');
        yield new Pattern('swine');
        yield new Pattern('traffic');
        yield new Pattern('trousers');
        yield new Pattern('trout');
        yield new Pattern('tuna');
        yield new Pattern('us');
        yield new Pattern('vermontese');
        yield new Pattern('wenchowese');
        yield new Pattern('wheat');
        yield new Pattern('whiting');
        yield new Pattern('wildebeest');
        yield new Pattern('yengeese');
    }
}
