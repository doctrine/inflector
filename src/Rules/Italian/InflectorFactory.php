<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Italian;

use Doctrine\Inflector\GenericLanguageInflectorFactory;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\WordInflector;

final class InflectorFactory extends GenericLanguageInflectorFactory
{
    /** @var class-string<WordInflector>|null */
    protected $rulesetInflector = RulesetInflector::class;

    protected function getSingularRuleset(): Ruleset
    {
        return Rules::getSingularRuleset();
    }

    protected function getPluralRuleset(): Ruleset
    {
        return Rules::getPluralRuleset();
    }
}
