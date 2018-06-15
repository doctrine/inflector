<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

class Substitution
{
    /** @var Word */
    private $singular;

    /** @var Word */
    private $plural;

    public function __construct(Word $singular, Word $plural)
    {
        $this->singular = $singular;
        $this->plural   = $plural;
    }

    public function getSingular() : Word
    {
        return $this->singular;
    }

    public function getPlural() : Word
    {
        return $this->plural;
    }
}
