<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector\Rules;

use Doctrine\Inflector\Inflector;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function sprintf;

abstract class LanguageFunctionalTestCase extends TestCase
{
    /** @return string[][] */
    abstract public static function dataSampleWords(): array;

    /** @dataProvider dataSampleWords */
    #[DataProvider('dataSampleWords')]
    public function testInflectingSingulars(string $singular, string $plural): void
    {
        self::assertSame(
            $singular,
            $this->createInflector()->singularize($plural),
            sprintf("'%s' should be singularized to '%s'", $plural, $singular)
        );
    }

    /** @dataProvider dataSampleWords */
    #[DataProvider('dataSampleWords')]
    public function testInflectingPlurals(string $singular, string $plural): void
    {
        self::assertSame(
            $plural,
            $this->createInflector()->pluralize($singular),
            sprintf("'%s' should be pluralized to '%s'", $singular, $plural)
        );
    }

    abstract protected function createInflector(): Inflector;
}
