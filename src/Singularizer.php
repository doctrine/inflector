<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

interface Singularizer
{
    /**
     * Returns a word in singular form.
     *
     * @param string $word The word in plural form.
     *
     * @return string The word in singular form.
     */
    public function singularize(string $word): string;
}
