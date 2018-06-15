<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

use Doctrine\Inflector\WordInflector;
use function preg_match;
use function preg_replace;

class Rules implements WordInflector
{
    /** @var Rule[] */
    private $rules;

    public function __construct(Rule ...$rules)
    {
        $this->rules = $rules;
    }

    public function inflect(string $word) : string
    {
        foreach ($this->rules as $rule) {
            if (preg_match($rule->getFrom(), $word) !== 0) {
                return preg_replace($rule->getFrom(), $rule->getTo(), $word);
            }
        }

        return $word;
    }
}
