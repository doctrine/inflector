<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

class Ruleset
{
    /** @var Rules */
    private $regular;

    /** @var Uninflected */
    private $uninflected;

    /** @var Irregular */
    private $irregular;

    public function __construct(Rules $regular, Uninflected $uninflected, Irregular $irregular)
    {
        $this->regular     = $regular;
        $this->uninflected = $uninflected;
        $this->irregular   = $irregular;
    }

    public function getRegular() : Rules
    {
        return $this->regular;
    }

    public function getUninflected() : Uninflected
    {
        return $this->uninflected;
    }

    public function getIrregular() : Irregular
    {
        return $this->irregular;
    }
}
