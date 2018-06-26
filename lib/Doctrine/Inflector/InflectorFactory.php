<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

class InflectorFactory
{
    /** @var WordInflector */
    private $singularInflector;

    /** @var WordInflector */
    private $pluralInflector;

    public function withSingularInflector(WordInflector $singularInflector) : self
    {
        $this->singularInflector = $singularInflector;

        return $this;
    }

    public function withPluralInflector(WordInflector $pluralInflector) : self
    {
        $this->pluralInflector = $pluralInflector;

        return $this;
    }

    public function build() : Inflector
    {
        $singularInflector = $this->singularInflector
            ?? new CachedWordInflector(new RulesetInflector((new SingularizerFactory())->build()));

        $pluralInflector = $this->pluralInflector
            ?? new CachedWordInflector(new RulesetInflector((new PluralizerFactory())->build()));

        return new Inflector($singularInflector, $pluralInflector);
    }
}
