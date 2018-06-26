<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

class Pattern
{
    /** @var string */
    private $regex;

    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    public function getRegex() : string
    {
        return $this->regex;
    }
}
