<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

/** @final */
class NoopWordInflector implements WordInflector
{
    public function inflect(string $word): string
    {
        return $word;
    }
}
