<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\NorwegianBokmal;

use Doctrine\Inflector\CachedWordInflector;
use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\RulesetInflector;

final class InflectorFactory
{
    public function __invoke() : Inflector
    {
        return new Inflector(
            new CachedWordInflector(new RulesetInflector(
                Rules::getSingularRuleset()
            )),
            new CachedWordInflector(new RulesetInflector(
                Rules::getPluralRuleset()
            ))
        );
    }
}
