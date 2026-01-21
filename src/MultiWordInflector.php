<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use function implode;
use function in_array;
use function mb_strlen;
use function mb_substr;
use function preg_match;

/**
 * Decorator that applies inflection to each word in a multi-word phrase.
 */
class MultiWordInflector implements WordInflector
{
    public const WORD_SEPARATORS = [' ', '-'];

    /** @var WordInflector */
    private $wordInflector;

    public function __construct(WordInflector $wordInflector)
    {
        $this->wordInflector = $wordInflector;
    }

    public function inflect(string $word): string
    {
        // If it's a single word or doesn't contain any word separators, use the original inflector
        if (preg_match('/[\s-]/', $word) !== 1) {
            return $this->wordInflector->inflect($word);
        }

        // Split the phrase into words while preserving separators
        $words       = [];
        $currentWord = '';
        $length      = mb_strlen($word);

        for ($i = 0; $i < $length; $i++) {
            $char = mb_substr($word, $i, 1);
            if (in_array($char, self::WORD_SEPARATORS, true)) {
                if ($currentWord !== '') {
                    $words[]     = $currentWord;
                    $currentWord = '';
                }

                $words[] = $char;
            } else {
                $currentWord .= $char;
            }
        }

        if ($currentWord !== '') {
            $words[] = $currentWord;
        }

        // Process each word
        $result = [];
        foreach ($words as $part) {
            if (in_array($part, self::WORD_SEPARATORS, true)) {
                $result[] = $part;
            } else {
                $result[] = $this->wordInflector->inflect($part);
            }
        }

        return implode('', $result);
    }
}
