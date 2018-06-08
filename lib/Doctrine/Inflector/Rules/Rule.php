<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

class Rule
{
    /** @var string */
    private $from;

    /** @var string */
    private $to;

    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to   = $to;
    }

    public function getFrom() : string
    {
        return $this->from;
    }

    public function getTo() : string
    {
        return $this->to;
    }
}
