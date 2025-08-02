<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

final class CachedWordInflector implements WordInflector
{
    /** @var string[] */
    private array $cache = [];

    public function __construct(private readonly WordInflector $wordInflector)
    {
    }

    public function inflect(string $word): string
    {
        return $this->cache[$word] ?? $this->cache[$word] = $this->wordInflector->inflect($word);
    }
}
