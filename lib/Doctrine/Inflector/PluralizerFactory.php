<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use Doctrine\Inflector\Rules\Irregular;
use Doctrine\Inflector\Rules\Plural;
use Doctrine\Inflector\Rules\Rules;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Uninflected;

final class PluralizerFactory
{
    /** @var Rules */
    private $rules;

    /** @var Uninflected */
    private $uninflected;

    /** @var Irregular */
    private $irregular;

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

    public function build() : Ruleset
    {
        $rules       = $this->rules ?? new Rules(...Plural::getDefaultRules());
        $uninflected = $this->uninflected ?? new Uninflected(...Plural::getUninflectedWords());
        $irregular   = $this->irregular ?? new Irregular(...Plural::getIrregularRules());

        $pluralUninflected = new Uninflected(...(static function () use ($uninflected) : iterable {
            yield from $uninflected->getWords();
            yield from Uninflected::getDefaultWords();
        })());

        return new Ruleset($rules, $pluralUninflected, $irregular);
    }
}
