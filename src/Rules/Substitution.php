<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

final class Substitution
{
    public function __construct(private Word $from, private Word $to)
    {
    }

    public function getFrom(): Word
    {
        return $this->from;
    }

    public function getTo(): Word
    {
        return $this->to;
    }
}
