<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use Doctrine\Inflector\Rules\Irregular;
use Doctrine\Inflector\Rules\Plural;
use Doctrine\Inflector\Rules\Rules;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Singular;
use Doctrine\Inflector\Rules\Uninflected;

class InflectorFactory
{
    public function createInflector(
        ?Ruleset $singularRuleset = null,
        ?Ruleset $pluralRuleset = null
    ) : Inflector {
        return new Inflector(
            new CachedWordInflector(new RulesetInflector(
                $singularRuleset ?? $this->createSingularRuleset()
            )),
            new CachedWordInflector(new RulesetInflector(
                $pluralRuleset ?? $this->createPluralRuleset()
            ))
        );
    }

    public function createSingularRuleset(
        ?Rules $rules = null,
        ?Uninflected $uninflected = null,
        ?Irregular $irregular = null,
        ?Irregular $pluralIrregular = null
    ) : Ruleset {
        $rules           = $rules ?? new Rules(...Singular::getDefaultRules());
        $uninflected     = $uninflected ?? new Uninflected(...Singular::getUninflectedWords());
        $irregular       = $irregular ?? new Irregular(...Singular::getIrregularRules());
        $pluralIrregular = $pluralIrregular ?? new Irregular(...Plural::getIrregularRules());

        $singularUninflected = new Uninflected(...(static function () use ($uninflected) : iterable {
            yield from $uninflected->getWords();
            yield from Uninflected::getDefaultWords();
        })());

        $singularIrregular = new Irregular(...(static function () use ($irregular, $pluralIrregular) : iterable {
            yield from $irregular->getRules();
            yield from $pluralIrregular->getFlippedRules();
        })());

        return new Ruleset($rules, $singularUninflected, $singularIrregular);
    }

    public function createPluralRuleset(
        ?Rules $rules = null,
        ?Uninflected $uninflected = null,
        ?Irregular $irregular = null
    ) : Ruleset {
        $rules       = $rules ?? new Rules(...Plural::getDefaultRules());
        $uninflected = $uninflected ?? new Uninflected(...Plural::getUninflectedWords());
        $irregular   = $irregular ?? new Irregular(...Plural::getIrregularRules());

        $pluralUninflected = new Uninflected(...(static function () use ($uninflected) : iterable {
            yield from $uninflected->getWords();
            yield from Uninflected::getDefaultWords();
        })());

        return new Ruleset($rules, $pluralUninflected, $irregular);
    }
}
