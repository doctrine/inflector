<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules;

use Doctrine\Inflector\WordInflector;
use Override;

use function array_combine;
use function array_map;
use function strtolower;
use function strtoupper;
use function substr;

final readonly class Substitutions implements WordInflector
{
    /** @var Substitution[] */
    private array $substitutions;

    public function __construct(Substitution ...$substitutions)
    {
        $this->substitutions = array_combine(
            array_map(
                static fn (Substitution $substitution): string => $substitution->getFrom()->getWord(),
                $substitutions,
            ),
            $substitutions,
        );
    }

    public function getFlippedSubstitutions(): Substitutions
    {
        $substitutions = [];

        foreach ($this->substitutions as $substitution) {
            $substitutions[] = new Substitution(
                $substitution->getTo(),
                $substitution->getFrom(),
            );
        }

        return new Substitutions(...$substitutions);
    }

    #[Override]
    public function inflect(string $word): string
    {
        $lowerWord = strtolower($word);

        if (isset($this->substitutions[$lowerWord])) {
            $firstLetterUppercase = $lowerWord[0] !== $word[0];

            $toWord = $this->substitutions[$lowerWord]->getTo()->getWord();

            if ($firstLetterUppercase) {
                return strtoupper($toWord[0]) . substr($toWord, 1);
            }

            return $toWord;
        }

        return $word;
    }
}
