<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use Override;

final class NoopWordInflector implements WordInflector
{
    #[Override]
    public function inflect(string $word): string
    {
        return $word;
    }
}
