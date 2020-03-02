<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\English;

use Doctrine\Inflector\CachedWordInflector;
use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\LanguageInflectorFactory;
use Doctrine\Inflector\RulesetInflector;

final class InflectorFactory implements LanguageInflectorFactory
{
    public function build() : Inflector
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
