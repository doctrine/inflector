<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use Doctrine\Inflector\Rules\Patterns;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Substitutions;
use Doctrine\Inflector\Rules\Transformations;
use Doctrine\Inflector\Rules\Word;

use function array_unshift;
use function is_array;

abstract class GenericLanguageInflectorFactory implements LanguageInflectorFactory
{
    /** @var Ruleset[] */
    private $singularRulesets = [];

    /** @var Ruleset[] */
    private $pluralRulesets = [];

    final public function __construct()
    {
        $this->singularRulesets[] = $this->getSingularRuleset();
        $this->pluralRulesets[]   = $this->getPluralRuleset();
    }

    final public function build(): Inflector
    {
        return new Inflector(
            new CachedWordInflector(new RulesetInflector(
                ...$this->singularRulesets
            )),
            new CachedWordInflector(new RulesetInflector(
                ...$this->pluralRulesets
            ))
        );
    }

    final public function withSingularRules(?Ruleset $singularRules, bool $reset = false): LanguageInflectorFactory
    {
        if ($reset) {
            $this->singularRulesets = [];
        }

        if ($singularRules instanceof Ruleset) {
            array_unshift($this->singularRulesets, $singularRules);
        }

        return $this;
    }

    final public function withPluralRules(?Ruleset $pluralRules, bool $reset = false): LanguageInflectorFactory
    {
        if ($reset) {
            $this->pluralRulesets = [];
        }

        if ($pluralRules instanceof Ruleset) {
            array_unshift($this->pluralRulesets, $pluralRules);
        }

        return $this;
    }

    final public function withIrregulars(?array $irregulars, bool $reset = false): LanguageInflectorFactory
    {
        if ($reset) {
            $this->pluralRulesets   = [];
            $this->singularRulesets = [];
        }

        if (is_array($irregulars)) {
            $newIrregulars = [];
            foreach ($irregulars as $irregular) {
                $newIrregulars[] = new Substitution(new Word($irregular[0]), new Word($irregular[1]));
            }

            $transf   = new Transformations();
            $patterns = new Patterns();
            $substs   = new Substitutions(...$newIrregulars);

            $plural   = new Ruleset($transf, $patterns, $substs);
            $singular = new Ruleset($transf, $patterns, $substs->getFlippedSubstitutions());

            array_unshift($this->pluralRulesets, $plural);
            array_unshift($this->singularRulesets, $singular);
        }

        return $this;
    }

    abstract protected function getSingularRuleset(): Ruleset;

    abstract protected function getPluralRuleset(): Ruleset;
}
