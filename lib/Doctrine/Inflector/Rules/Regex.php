<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

final class Regex
{
    /** @var Pattern */
    private $pattern;

    /** @var string */
    private $replacement;

    public function __construct(Pattern $pattern, string $replacement)
    {
        $this->pattern     = $pattern;
        $this->replacement = $replacement;
    }

    public function getPattern() : Pattern
    {
        return $this->pattern;
    }

    public function getReplacement() : string
    {
        return $this->replacement;
    }
}
