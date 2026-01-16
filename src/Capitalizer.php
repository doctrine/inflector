<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

interface Capitalizer
{
    /**
     * Uppercases words with configurable delimiters between words.
     *
     * Takes a string and capitalizes all of the words, like PHP's built-in
     * ucwords function. This extends that behavior, however, by allowing the
     * word delimiters to be configured, rather than only separating on
     * whitespace.
     *
     * Here is an example:
     * <code>
     * <?php
     * $string = 'top-o-the-morning to all_of_you!';
     * echo $inflector->capitalize($string);
     * // Top-O-The-Morning To All_of_you!
     *
     * echo $inflector->capitalize($string, '-_ ');
     * // Top-O-The-Morning To All_Of_You!
     * ?>
     * </code>
     *
     * @param string $string     The string to operate on.
     * @param string $delimiters A list of word separators.
     *
     * @return string The string with all delimiter-separated words capitalized.
     */
    public function capitalize(string $string, string $delimiters = " \n\t\r\0\x0B-"): string;
}
