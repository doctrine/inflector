# Upgrade to 2.2.x

## `@final` annotations added to classes

Several classes have been marked with `@final` and should not be extended:

- `Doctrine\Inflector\Inflector`
- `Doctrine\Inflector\CachedWordInflector`
- `Doctrine\Inflector\NoopWordInflector`
- `Doctrine\Inflector\RulesetInflector`
- `Doctrine\Inflector\Rules\Word`
- `Doctrine\Inflector\Rules\Ruleset`
- `Doctrine\Inflector\Rules\Patterns`
- `Doctrine\Inflector\Rules\Substitutions`
- `Doctrine\Inflector\Rules\Transformations`
- `Doctrine\Inflector\Rules\English\Inflectible`
- `Doctrine\Inflector\Rules\Esperanto\Inflectible`
- `Doctrine\Inflector\Rules\French\Inflectible`
- `Doctrine\Inflector\Rules\Italian\Inflectible`
- `Doctrine\Inflector\Rules\NorwegianBokmal\Inflectible`
- `Doctrine\Inflector\Rules\Portuguese\Inflectible`
- `Doctrine\Inflector\Rules\Spanish\Inflectible`
- `Doctrine\Inflector\Rules\Swedish\Inflectible`
- `Doctrine\Inflector\Rules\Turkish\Inflectible`

`Doctrine\Inflector\Inflector` is the main public API of this package, and now
implements fine-grained interfaces for each of its methods, which are themselves
composed of smaller atomic interfaces.

Atomic interfaces:

- `Tableizer`
- `Classifier`
- `Camelizer`
- `Capitalizer`
- `Pluralizer`
- `Singularizer`
- `Slugifier`
- `Unaccenter` - `unaccent()` and `seemsUtf8()` methods

Grouped convenience interfaces:

- `CaseConverter` - extends `Tableizer`, `Classifier`, `Camelizer`, `Capitalizer`
- `Pluralization` - extends `Pluralizer`, `Singularizer`
