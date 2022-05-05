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

        yield new Pattern('.*ss');
        yield new Pattern('clothes');
        yield new Pattern('data');
        yield new Pattern('fascia');
        yield new Pattern('fuchsia');
        yield new Pattern('galleria');
        yield new Pattern('mafia');
        yield new Pattern('militia');
        yield new Pattern('pantaloni');
        yield new Pattern('petunia');
        yield new Pattern('sepia');
        yield new Pattern('trivia');
        yield new Pattern('utopia');
    }

    /**
     * @return Pattern[]
     */
    public static function getPlural() : iterable
    {
        yield from self::getDefault();

        yield new Pattern('media');
    }

    /**
     * @return Pattern[]
     */
    private static function getDefault() : iterable
    {
        yield new Pattern('\w+media');
        yield new Pattern('advice');
        yield new Pattern('art');
        yield new Pattern('audio');
        yield new Pattern('borghese');
        yield new Pattern('buffalo');
        yield new Pattern('chassis');
        yield new Pattern('clippers');
        yield new Pattern('cotton');
        yield new Pattern('data');
        yield new Pattern('education');
        yield new Pattern('emoji');
        yield new Pattern('equipment');
        yield new Pattern('evidence');
        yield new Pattern('feedback');
        yield new Pattern('food');
        yield new Pattern('furniture');
        yield new Pattern('gold');
        yield new Pattern('herpes');
        yield new Pattern('homework');
        yield new Pattern('information');
        yield new Pattern('jeans');
        yield new Pattern('knowledge');
        yield new Pattern('love');
        yield new Pattern('Maltese');
        yield new Pattern('management');
        yield new Pattern('metadata');
        yield new Pattern('money');
        yield new Pattern('music');
        yield new Pattern('news');
        yield new Pattern('nutrition');
        yield new Pattern('oil');
        yield new Pattern('patience');
        yield new Pattern('pistoiese');
        yield new Pattern('pokemon');
        yield new Pattern('police');
        yield new Pattern('polish');
        yield new Pattern('portoghese');
        yield new Pattern('progress');
        yield new Pattern('research');
        yield new Pattern('scissors');
        yield new Pattern('series');
        yield new Pattern('social media');
        yield new Pattern('spam');
        yield new Pattern('species');
        yield new Pattern('staff');
        yield new Pattern('sugar');
        yield new Pattern('talent');
        yield new Pattern('traffic');
        yield new Pattern('travel');
        yield new Pattern('weather');
        yield new Pattern('wood');
    }
}
