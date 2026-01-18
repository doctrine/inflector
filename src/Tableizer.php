<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

interface Tableizer
{
    /**
     * Converts a word into the format for a Doctrine table name. Converts 'ModelName' to 'model_name'.
     */
    public function tableize(string $word): string;
}
