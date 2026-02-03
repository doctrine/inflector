<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

use function array_map;
use function implode;
use function preg_match;

final readonly class Patterns
{
    private string $regex;

    public function __construct(Pattern ...$patterns)
    {
        $patterns = array_map(static fn (Pattern $pattern): string => $pattern->getPattern(), $patterns);

        $this->regex = '/^(?:' . implode('|', $patterns) . ')$/i';
    }

    public function matches(string $word): bool
    {
        return preg_match($this->regex, $word, $regs) === 1;
    }
}
