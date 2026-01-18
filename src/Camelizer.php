<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

interface Camelizer
{
    /**
     * Camelizes a word. This uses the classify() method and turns the first character to lowercase.
     */
    public function camelize(string $word): string;
}
