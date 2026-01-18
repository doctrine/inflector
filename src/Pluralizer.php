<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

interface Pluralizer
{
    /**
     * Returns a word in plural form.
     *
     * @param string $word The word in singular form.
     *
     * @return string The word in plural form.
     */
    public function pluralize(string $word): string;
}
