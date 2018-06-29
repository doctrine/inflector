<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use Doctrine\Inflector\Rules\Ruleset;

class RulesetInflector implements WordInflector
{
    /** @var Ruleset */
    private $ruleset;

    public function __construct(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;
    }

    public function inflect(string $word) : string
    {
        if ($word === '') {
            return '';
        }

        if ($this->ruleset->getUninflected()->matches($word)) {
            return $word;
        }

        $inflected = $this->ruleset->getIrregular()->inflect($word);

        if ($inflected !== $word) {
            return $inflected;
        }

        return $this->ruleset->getRegular()->inflect($word);
    }
}
