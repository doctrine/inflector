<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use function lcfirst;
use function mb_strtolower;
use function preg_replace;
use function str_replace;
use function ucwords;

class Inflector
{
    /** @var WordInflector */
    private $singularizer;

    /** @var WordInflector */
    private $pluralizer;

    public function __construct(WordInflector $singularizer, WordInflector $pluralizer)
    {
        $this->singularizer = $singularizer;
        $this->pluralizer   = $pluralizer;
    }

    /**
     * Converts a word into the format for a Doctrine table name. Converts 'ModelName' to 'model_name'.
     */
    public function tableize(string $word) : string
    {
        return mb_strtolower(preg_replace('~(?<=\\w)([A-Z])~u', '_$1', $word));
    }

    /**
     * Converts a word into the format for a Doctrine class name. Converts 'table_name' to 'TableName'.
     */
    public function classify(string $word) : string
    {
        return str_replace([' ', '_', '-'], '', ucwords($word, ' _-'));
    }

    /**
     * Camelizes a word. This uses the classify() method and turns the first character to lowercase.
     */
    public function camelize(string $word) : string
    {
        return lcfirst($this->classify($word));
    }

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
    public function capitalize(string $string, string $delimiters = " \n\t\r\0\x0B-") : string
    {
        return ucwords($string, $delimiters);
    }

    /**
     * Returns a word in singular form.
     *
     * @param string $word The word in plural form.
     *
     * @return string The word in singular form.
     */
    public function singularize(string $word) : string
    {
        return $this->singularizer->inflect($word);
    }

    /**
     * Returns a word in plural form.
     *
     * @param string $word The word in singular form.
     *
     * @return string The word in plural form.
     */
    public function pluralize(string $word) : string
    {
        return $this->pluralizer->inflect($word);
    }
}
