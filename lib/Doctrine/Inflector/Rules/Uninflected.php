<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

use function array_map;
use function implode;
use function preg_match;

class Uninflected
{
    /** @var Word[] */
    private $words;

    /** @var string|null */
    private $regex;

    public function __construct(Word ...$words)
    {
        $this->words = $words;
    }

    /**
     * @return Word[]
     */
    public static function getDefaultWords() : iterable
    {
        yield new Word('\w+media');
        yield new Word('Amoyese');
        yield new Word('audio');
        yield new Word('bison');
        yield new Word('Borghese');
        yield new Word('bream');
        yield new Word('breeches');
        yield new Word('britches');
        yield new Word('buffalo');
        yield new Word('cantus');
        yield new Word('carp');
        yield new Word('chassis');
        yield new Word('clippers');
        yield new Word('cod');
        yield new Word('coitus');
        yield new Word('compensation');
        yield new Word('Congoese');
        yield new Word('contretemps');
        yield new Word('coreopsis');
        yield new Word('corps');
        yield new Word('data');
        yield new Word('debris');
        yield new Word('deer');
        yield new Word('diabetes');
        yield new Word('djinn');
        yield new Word('education');
        yield new Word('eland');
        yield new Word('elk');
        yield new Word('emoji');
        yield new Word('equipment');
        yield new Word('evidence');
        yield new Word('Faroese');
        yield new Word('feedback');
        yield new Word('fish');
        yield new Word('flounder');
        yield new Word('Foochowese');
        yield new Word('Furniture');
        yield new Word('furniture');
        yield new Word('gallows');
        yield new Word('Genevese');
        yield new Word('Genoese');
        yield new Word('Gilbertese');
        yield new Word('gold');
        yield new Word('headquarters');
        yield new Word('herpes');
        yield new Word('hijinks');
        yield new Word('Hottentotese');
        yield new Word('information');
        yield new Word('innings');
        yield new Word('jackanapes');
        yield new Word('jedi');
        yield new Word('Kiplingese');
        yield new Word('knowledge');
        yield new Word('Kongoese');
        yield new Word('love');
        yield new Word('Lucchese');
        yield new Word('Luggage');
        yield new Word('mackerel');
        yield new Word('Maltese');
        yield new Word('metadata');
        yield new Word('mews');
        yield new Word('moose');
        yield new Word('mumps');
        yield new Word('Nankingese');
        yield new Word('news');
        yield new Word('nexus');
        yield new Word('Niasese');
        yield new Word('nutrition');
        yield new Word('offspring');
        yield new Word('Pekingese');
        yield new Word('Piedmontese');
        yield new Word('pincers');
        yield new Word('Pistoiese');
        yield new Word('plankton');
        yield new Word('pliers');
        yield new Word('pokemon');
        yield new Word('police');
        yield new Word('Portuguese');
        yield new Word('proceedings');
        yield new Word('rabies');
        yield new Word('rain');
        yield new Word('rhinoceros');
        yield new Word('rice');
        yield new Word('salmon');
        yield new Word('Sarawakese');
        yield new Word('scissors');
        yield new Word('sea[- ]bass');
        yield new Word('series');
        yield new Word('Shavese');
        yield new Word('shears');
        yield new Word('sheep');
        yield new Word('siemens');
        yield new Word('species');
        yield new Word('staff');
        yield new Word('swine');
        yield new Word('traffic');
        yield new Word('trousers');
        yield new Word('trout');
        yield new Word('tuna');
        yield new Word('us');
        yield new Word('Vermontese');
        yield new Word('Wenchowese');
        yield new Word('wheat');
        yield new Word('whiting');
        yield new Word('wildebeest');
        yield new Word('Yengeese');
    }

    /**
     * @return Word[]
     */
    public function getWords() : iterable
    {
        yield from $this->words;
    }

    public function isUninflected(string $word) : bool
    {
        return preg_match('/^(' . $this->getRegex() . ')$/i', $word, $regs) === 1;
    }

    private function getRegex() : string
    {
        if ($this->regex === null) {
            $words = array_map(function (Word $word) : string {
                return $word->getWord();
            }, $this->words);

            $this->regex = '(?:' . implode('|', $words) . ')';
        }

        return $this->regex;
    }
}
