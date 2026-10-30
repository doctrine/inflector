<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Italian;

use Doctrine\Inflector\MultiWordInflector;

use function implode;
use function preg_split;
use function strpos;

use const PREG_SPLIT_DELIM_CAPTURE;
use const PREG_SPLIT_NO_EMPTY;

class RulesetInflector extends \Doctrine\Inflector\RulesetInflector
{
    public function inflect(string $word): string
    {
        // If it's a single word without spaces or hyphens, use the original inflector
        if (strpos($word, ' ') === false && strpos($word, '-') === false) {
            return parent::inflect($word);
        }

        // Split the phrase into words and process each one
        $regex = '/([' . implode('', MultiWordInflector::WORD_SEPARATORS) . '])/';
        $words = preg_split($regex, $word, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        if ($words === false) {
            return parent::inflect($word);
        }

        $result = [];
        foreach ($words as $part) {
            if ($part === ' ' || $part === '-') {
                $result[] = $part;
                continue;
            }

            // Process each word individually
            $result[] = parent::inflect($part);
        }

        return implode('', $result);
    }
}
