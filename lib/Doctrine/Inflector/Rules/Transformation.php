<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

class Transformation
{
    /** @var Regex */
    private $pluralization;

    /** @var Regex */
    private $singularization;

    public function __construct(Regex $pluralization, Regex $singularization)
    {
        $this->pluralization   = $pluralization;
        $this->singularization = $singularization;
    }

    public function getPluralization() : Regex
    {
        return $this->pluralization;
    }

    public function getSingularization() : Regex
    {
        return $this->singularization;
    }
}
