<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Italian;

use Doctrine\Inflector\GenericLanguageInflectorFactory;
use Doctrine\Inflector\Rules\Ruleset;
use Override;

final class InflectorFactory extends GenericLanguageInflectorFactory
{
    #[Override]
    protected function getSingularRuleset(): Ruleset
    {
        return Rules::getSingularRuleset();
    }

    #[Override]
    protected function getPluralRuleset(): Ruleset
    {
        return Rules::getPluralRuleset();
    }
}
