Introduction
============

The Doctrine Inflector project is a small library that can perform string manipulations with regard to uppercase/lowercase and singular/plural forms of words.

Usage
-----

All the methods of ``Doctrine\Common\Inflector`` are static methods:

Converts a word into the format for a Doctrine class name.

.. code-block:: php
    use Doctrine\Common\Inflector;

    $name = Inflector::classify('table_name');
    //returns TableName


Camelizes a word. This uses the classify() method and turns the first character to lowercase.

.. code-block:: php
    use Doctrine\Common\Inflector;

    $name = Inflector::camelize('table_name');
    //returns tableName
    

Uppercases words with configurable delimiters between words.

.. code-block:: php
    use Doctrine\Common\Inflector;

    $name = Inflector::ucwords('top-o-the-morning to all_of_you!', " \n\t\r\0\x0B-");//The delitmiters passed in this example are the defaults one.
    //returns Top-O-The-Morning To All_of_you!
    
 
Adds custom inflection $rules, of either 'plural' or 'singular' $type.
 
 .. code-block:: php
    use Doctrine\Common\Inflector;

    Inflector::rules('plural', ['/^(inflect)or$/i' => '\1ables']);
    Inflector::rules('plural', [
        'rules' => ['/^(inflect)ors$/i' => '\1ables'],
        'uninflected' => ['dontinflectme'],
        'irregular' => ['red' => 'redlings'],
    ]);
    
 
Clears Inflectors inflected value caches, and resets the inflection rules to the initial values.
  
 .. code-block:: php
    use Doctrine\Common\Inflector;

    $name = Inflector::reset();


Returns a word in plural form.


.. code-block:: php
    use Doctrine\Common\Inflector;

    $name = Inflector::pluralize('child');
    //returns children


Returns a word in singular form.

.. code-block:: php
    use Doctrine\Common\Inflector;

    $name = Inflector::singularize('fungi');
    //returns fungus
