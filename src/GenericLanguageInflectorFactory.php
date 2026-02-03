<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use Doctrine\Inflector\Rules\Ruleset;
use Override;

use function array_unshift;

abstract class GenericLanguageInflectorFactory implements LanguageInflectorFactory
{
    /** @var Ruleset[] */
    private array $singularRulesets = [];

    /** @var Ruleset[] */
    private array $pluralRulesets = [];

    final public function __construct()
    {
        $this->singularRulesets[] = $this->getSingularRuleset();
        $this->pluralRulesets[]   = $this->getPluralRuleset();
    }

    #[Override]
    final public function build(): Inflector
    {
        return new Inflector(
            new CachedWordInflector(new RulesetInflector(
                ...$this->singularRulesets,
            )),
            new CachedWordInflector(new RulesetInflector(
                ...$this->pluralRulesets,
            )),
        );
    }

    #[Override]
    final public function withSingularRules(Ruleset|null $singularRules, bool $reset = false): LanguageInflectorFactory
    {
        if ($reset) {
            $this->singularRulesets = [];
        }

        if ($singularRules instanceof Ruleset) {
            array_unshift($this->singularRulesets, $singularRules);
        }

        return $this;
    }

    #[Override]
    final public function withPluralRules(Ruleset|null $pluralRules, bool $reset = false): LanguageInflectorFactory
    {
        if ($reset) {
            $this->pluralRulesets = [];
        }

        if ($pluralRules instanceof Ruleset) {
            array_unshift($this->pluralRulesets, $pluralRules);
        }

        return $this;
    }

    abstract protected function getSingularRuleset(): Ruleset;

    abstract protected function getPluralRuleset(): Ruleset;
}
