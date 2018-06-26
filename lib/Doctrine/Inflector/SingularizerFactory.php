<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use Doctrine\Inflector\Rules\Irregular;
use Doctrine\Inflector\Rules\Plural;
use Doctrine\Inflector\Rules\Rules;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Singular;
use Doctrine\Inflector\Rules\Uninflected;

final class SingularizerFactory
{
    /** @var Rules */
    private $rules;

    /** @var Uninflected */
    private $uninflected;

    /** @var Irregular */
    private $irregular;

    /** @var Irregular */
    private $pluralIrregular;

    public function withRules(Rules $rules) : self
    {
        $this->rules = $rules;

        return $this;
    }

    public function withUninflected(Uninflected $uninflected) : self
    {
        $this->uninflected = $uninflected;

        return $this;
    }

    public function withIrregular(Irregular $irregular) : self
    {
        $this->irregular = $irregular;

        return $this;
    }

    public function withPluralIrregular(Irregular $pluralIrregular) : self
    {
        $this->pluralIrregular = $pluralIrregular;

        return $this;
    }

    public function build() : Ruleset
    {
        $rules           = $this->rules ?? new Rules(...Singular::getDefaultRules());
        $uninflected     = $this->uninflected ?? new Uninflected(...Singular::getUninflectedWords());
        $irregular       = $this->irregular ?? new Irregular(...Singular::getIrregularRules());
        $pluralIrregular = $this->pluralIrregular ?? new Irregular(...Plural::getIrregularRules());

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
}
