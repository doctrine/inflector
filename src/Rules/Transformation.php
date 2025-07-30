<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

use Doctrine\Inflector\WordInflector;

use function preg_replace;

final class Transformation implements WordInflector
{
    public function __construct(private Pattern $pattern, private string $replacement)
    {
    }

    public function getPattern(): Pattern
    {
        return $this->pattern;
    }

    public function getReplacement(): string
    {
        return $this->replacement;
    }

    public function inflect(string $word): string
    {
        return (string) preg_replace($this->pattern->getRegex(), $this->replacement, $word);
    }
}
