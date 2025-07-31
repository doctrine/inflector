<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

class CachedWordInflector implements WordInflector
{
    /** @var string[] */
    private array $cache = [];

    public function __construct(private WordInflector $wordInflector)
    {
    }

    public function inflect(string $word): string
    {
        return $this->cache[$word] ?? $this->cache[$word] = $this->wordInflector->inflect($word);
    }
}
