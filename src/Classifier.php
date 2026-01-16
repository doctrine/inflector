<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

interface Classifier
{
    /**
     * Converts a word into the format for a Doctrine class name. Converts 'table_name' to 'TableName'.
     */
    public function classify(string $word): string;
}
