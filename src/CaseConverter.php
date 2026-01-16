<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

/**
 * Convenience interface grouping case conversion operations.
 */
interface CaseConverter extends Tableizer, Classifier, Camelizer, Capitalizer
{
}
