<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

class NopInflector implements WordInflector
{
    public function inflect(string $word) : string
    {
        return $word;
    }
}
