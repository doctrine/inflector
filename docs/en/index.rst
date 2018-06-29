Introduction
============

The Doctrine Inflector has static methods for inflecting text.
The features include pluralization, singularization,
converting between camelCase and under_score and capitalizing
words.

All you need to use the Inflector is the ``Doctrine\Common\Inflector\Inflector``
class.

Installation
============

You can install the Inflector with composer:

.. code-block::

    $ composer require doctrine/inflector

Here are the available methods that you can use:

Default Setup
=============

If you want to use the default rules for a language you can use the following. The following languages are supported.

- English
- French
- Norwegian Bokmal
- Portuguese
- Spanish
- Turkish

English
-------

.. code-block:: php

    use Doctrine\Inflector\CachedWordInflector;
    use Doctrine\Inflector\RulesetInflector;
    use Doctrine\Inflector\Rules\English;

    $inflector = new Inflector(
        new CachedWordInflector(new RulesetInflector(
            English\Rules::getSingularRuleset()
        )),
        new CachedWordInflector(new RulesetInflector(
            English\Rules::getPluralRuleset()
        ))
    );

French
------

.. code-block:: php

    use Doctrine\Inflector\CachedWordInflector;
    use Doctrine\Inflector\RulesetInflector;
    use Doctrine\Inflector\Rules\French;

    $inflector = new Inflector(
        new CachedWordInflector(new RulesetInflector(
            French\Rules::getSingularRuleset()
        )),
        new CachedWordInflector(new RulesetInflector(
            French\Rules::getPluralRuleset()
        ))
    );

Norwegian Bokmal
----------------

.. code-block:: php

    use Doctrine\Inflector\CachedWordInflector;
    use Doctrine\Inflector\RulesetInflector;
    use Doctrine\Inflector\Rules\NorwegianBokmal;

    $inflector = new Inflector(
        new CachedWordInflector(new RulesetInflector(
            NorwegianBokmal\Rules::getSingularRuleset()
        )),
        new CachedWordInflector(new RulesetInflector(
            NorwegianBokmal\Rules::getPluralRuleset()
        ))
    );

Portuguese
----------

.. code-block:: php

    use Doctrine\Inflector\CachedWordInflector;
    use Doctrine\Inflector\RulesetInflector;
    use Doctrine\Inflector\Rules\Portuguese;

    $inflector = new Inflector(
        new CachedWordInflector(new RulesetInflector(
            Portuguese\Rules::getSingularRuleset()
        )),
        new CachedWordInflector(new RulesetInflector(
            Portuguese\Rules::getPluralRuleset()
        ))
    );

Spanish
-------

.. code-block:: php

    use Doctrine\Inflector\CachedWordInflector;
    use Doctrine\Inflector\RulesetInflector;
    use Doctrine\Inflector\Rules\Spanish;

    $inflector = new Inflector(
        new CachedWordInflector(new RulesetInflector(
            Spanish\Rules::getSingularRuleset()
        )),
        new CachedWordInflector(new RulesetInflector(
            Spanish\Rules::getPluralRuleset()
        ))
    );

Turkish
-------

.. code-block:: php

    use Doctrine\Inflector\CachedWordInflector;
    use Doctrine\Inflector\RulesetInflector;
    use Doctrine\Inflector\Rules\Turkish;

    $inflector = new Inflector(
        new CachedWordInflector(new RulesetInflector(
            Turkish\Rules::getSingularRuleset()
        )),
        new CachedWordInflector(new RulesetInflector(
            Turkish\Rules::getPluralRuleset()
        ))
    );

Adding Languages
----------------

If you are interested in adding support for your language, take a look at the other languages defined in the
``Doctrine\Inflector\Rules`` namespace and the tests located in ``Doctrine\Tests\Inflector\Rules``. You can copy
one of the languages and update the rules for your language.

Once you have done this, send a pull request to the ``doctrine/inflector`` repository with the additions.

Custom Setup
============

If you want to setup custom singular and plural rules, you can configure the inflector like this.

.. code-block:: php

    use Doctrine\Inflector\CachedWordInflector;
    use Doctrine\Inflector\Inflector;
    use Doctrine\Inflector\Rules\Pattern;
    use Doctrine\Inflector\Rules\Patterns;
    use Doctrine\Inflector\Rules\Ruleset;
    use Doctrine\Inflector\Rules\Substitution;
    use Doctrine\Inflector\Rules\Substitutions;
    use Doctrine\Inflector\Rules\Transformation;
    use Doctrine\Inflector\Rules\Transformations;
    use Doctrine\Inflector\Rules\Word;
    use Doctrine\Inflector\RulesetInflector;

    $inflector = new Inflector(
        new CachedWordInflector(new RulesetInflector(
            new Ruleset(
                new Transformations(
                    new Transformation(new Pattern('/^(bil)er$/i'), '\1'),
                    new Transformation(new Pattern('/^(inflec|contribu)tors$/i'), '\1ta')
                ),
                new Patterns(new Pattern('singulars')),
                new Substitutions(new Substitution(new Word('spins'), new Word('spinor')))
            )
        )),
        new CachedWordInflector(new RulesetInflector(
            new Ruleset(
                new Transformations(
                    new Transformation(new Pattern('^(bil)er$'), '\1'),
                    new Transformation(new Pattern('^(inflec|contribu)tors$'), '\1ta')
                ),
                new Patterns(new Pattern('noflect'), new Pattern('abtuse')),
                new Substitutions(
                    new Substitution(new Word('amaze'), new Word('amazable')),
                    new Substitution(new Word('phone'), new Word('phonezes'))
                )
            )
        ))
    );

Tableize
========

Converts ``ModelName`` to ``model_name``:

.. code-block:: php

    echo $inflector->tableize('ModelName'); // model_name

Classify
========

Converts ``model_name`` to ``ModelName``:

.. code-block:: php

    echo $inflector->classify('model_name'); // ModelName

Camelize
========

This method uses `Classify`_ and then converts the first character to lowercase:

.. code-block:: php

    echo $inflector->camelize('model_name'); // modelName

capitalize
==========

Takes a string and capitalizes all of the words, like PHP's built-in
``ucwords`` function. This extends that behavior, however, by allowing the
word delimiters to be configured, rather than only separating on
whitespace.

Here is an example:

.. code-block:: php

    $string = 'top-o-the-morning to all_of_you!';

    echo $inflector->capitalize($string); // Top-O-The-Morning To All_of_you!

    echo $inflector->capitalize($string, '-_ '); // Top-O-The-Morning To All_Of_You!

Pluralize
=========

Returns a word in plural form.

.. code-block:: php

    echo $inflector->pluralize('browser'); // browsers

Singularize
===========

.. code-block:: php

    echo $inflector->singularize('browsers'); // browser

Slugify
=======

You can easily use the Inflector to create a slug from a string of text
by using the `tableize`_ method and replacing underscores with hyphens:

.. code-block:: php

    public static function slugify(string $text) : string
    {
        return str_replace('_', '-', Inflector::tableize($text));
    }

Acknowledgements
================

The language rules in this library have been adapted from several different sources, including but not limited to:

- [Ruby On Rails Inflector](http://api.rubyonrails.org/classes/ActiveSupport/Inflector.html)
- [ICanBoogie Inflector](https://github.com/ICanBoogie/Inflector)
- [CakePHP Inflector](https://book.cakephp.org/3.0/en/core-libraries/inflector.html)
