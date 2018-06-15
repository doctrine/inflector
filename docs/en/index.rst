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

If you want to use the default rules that come with Doctrine you can use the following.

.. code-block:: php

    use Doctrine\Inflector\InflectorFactory;

    $inflectorFactory = new InflectorFactory();

    $inflector = $inflectorFactory->createInflector();

Custom Setup
============

If you want to setup custom singular and plural rules, you can configure the inflector like this.

.. code-block:: php

    use Doctrine\Inflector\InflectorFactory;
    use Doctrine\Inflector\Rules\Irregular;
    use Doctrine\Inflector\Rules\Rule;
    use Doctrine\Inflector\Rules\Rules;
    use Doctrine\Inflector\Rules\Uninflected;
    use Doctrine\Inflector\Rules\Word;

    $inflectorFactory = new InflectorFactory();

    $inflector = $inflectorFactory->createInflector(
        $inflectorFactory->createSingularRuleset(
            new Rules(
                new Rule('/^(bil)er$/i', '\1'),
                new Rule('/^(inflec|contribu)tors$/i', '\1ta')
            ),
            new Uninflected(new Word('singulars')),
            new Irregular(new Rule('spins', 'spinor'))
        ),
        $inflectorFactory->createPluralRuleset(
            new Rules(new Rule('/^(alert)$/i', '\1ables')),
            new Uninflected(new Word('noflect'), new Word('abtuse')),
            new Irregular(
                new Rule('amaze', 'amazable'),
                new Rule('phone', 'phonezes')
            )
        )
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
