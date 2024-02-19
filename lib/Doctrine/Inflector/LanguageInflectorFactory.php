<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use Doctrine\Inflector\Rules\Ruleset;

interface LanguageInflectorFactory
{
    /**
     * Applies custom rules for singularisation
     *
     * @param bool $reset If true, will unset default inflections for all new rules
     *
     * @return $this
     */
    public function withSingularRules(?Ruleset $singularRules, bool $reset = false): self;

    /**
     * Applies custom rules for pluralisation
     *
     * @param bool $reset If true, will unset default inflections for all new rules
     *
     * @return $this
     */
    public function withPluralRules(?Ruleset $pluralRules, bool $reset = false): self;

    /**
     * Applies custom rules for irregular words
     *
     * @param mixed[][] $irregulars Array of arrays of strings in the format [['singular', 'plural'], ...]
     * @param bool      $reset      If true, will unset default inflections for all new rules
     *
     * @return $this
     */
    public function withIrregulars(?array $irregulars, bool $reset = false): self;

    /**
     * Builds the inflector instance with all applicable rules
     */
    public function build(): Inflector;
}
