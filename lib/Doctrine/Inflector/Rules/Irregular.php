<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

use Doctrine\Inflector\WordInflector;
use function array_keys;
use function array_values;
use function implode;
use function preg_match;
use function strtolower;
use function substr;

class Irregular implements WordInflector
{
    /** @var Rule[] */
    private $rules;

    /** @var string|null */
    private $regex;

    public function __construct(Rule ...$rules)
    {
        foreach ($rules as $rule) {
            $this->rules[$rule->getFrom()] = $rule;
        }
    }

    /**
     * @return Rule[]
     */
    public function getFlippedRules() : iterable
    {
        foreach ($this->rules as $rule) {
            yield new Rule($rule->getTo(), $rule->getFrom());
        }
    }

    /**
     * @return Rule[]
     */
    public function getRules() : iterable
    {
        yield from array_values($this->rules);
    }

    public function inflect(string $word) : string
    {
        if (preg_match('/(.*)\\b(' . $this->getRegex() . ')$/i', $word, $regs)) {
            return $regs[1] . $word[0] . substr($this->rules[strtolower($regs[2])]->getTo(), 1);
        }

        return $word;
    }

    private function getRegex() : string
    {
        if ($this->regex === null) {
            $this->regex = '(?:' . implode('|', array_keys($this->rules)) . ')';
        }

        return $this->regex;
    }
}
