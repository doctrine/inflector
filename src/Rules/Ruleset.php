<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

readonly class Ruleset
{
    public function __construct(
        private Transformations $regular,
        private Patterns $uninflected,
        private Substitutions $irregular,
    ) {
    }

    public function getRegular(): Transformations
    {
        return $this->regular;
    }

    public function getUninflected(): Patterns
    {
        return $this->uninflected;
    }

    public function getIrregular(): Substitutions
    {
        return $this->irregular;
    }
}
