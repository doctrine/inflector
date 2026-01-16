<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

interface Unaccenter
{
    /**
     * Checks if the given string seems like it has utf8 characters in it.
     *
     * @param string $string The string to check for utf8 characters in.
     */
    public function seemsUtf8(string $string): bool;

    /**
     * Remove any illegal characters, accents, etc.
     *
     * @param  string $string String to unaccent
     *
     * @return string Unaccented string
     */
    public function unaccent(string $string): string;
}
