<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

interface LanguageInflectorFactory
{
    /**
     * Builds the inflector instance with all applicable rules
     */
    public function build() : Inflector;
}
