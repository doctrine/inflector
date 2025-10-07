Introdução
============

O **Doctrine Inflector** possui métodos para realizar transformações linguísticas em textos.  
As funcionalidades incluem pluralização, singularização, conversão entre *camelCase* e *under_score*  
e capitalização de palavras.

Instalação
============

Você pode instalar o **Inflector** com o *Composer*:

.. code-block:: console

    $ composer require doctrine/inflector

Uso
=====

Usar o inflector é simples. Você pode criar uma nova instância de  
``Doctrine\Inflector\Inflector`` utilizando a classe  
``Doctrine\Inflector\InflectorFactory``:

.. code-block:: php

    use Doctrine\Inflector\InflectorFactory;

    $inflector = InflectorFactory::create()->build();

Por padrão, ele criará um inflector para o idioma **inglês**.  
Se quiser usar outro idioma, basta passar o idioma desejado  
para o método ``createForLanguage()``:

.. code-block:: php

    use Doctrine\Inflector\InflectorFactory;
    use Doctrine\Inflector\Language;

    $inflector = InflectorFactory::createForLanguage(Language::SPANISH)->build();

Idiomas suportados
------------------

Os idiomas atualmente suportados são:

- ``Language::ENGLISH`` — Inglês  
- ``Language::ESPERANTO`` — Esperanto  
- ``Language::FRENCH`` — Francês  
- ``Language::NORWEGIAN_BOKMAL`` — Norueguês (Bokmål)  
- ``Language::PORTUGUESE`` — Português  
- ``Language::SPANISH`` — Espanhol  
- ``Language::TURKISH`` — Turco  

Construindo manualmente o inflector
------------------------------------

Se preferir construir o inflector manualmente em vez de usar a *factory*,  
você pode fazer assim:

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

Adicionando novos idiomas
-------------------------

Se você estiver interessado em adicionar suporte para outro idioma,  
consulte os exemplos de outros idiomas definidos no namespace  
``Doctrine\Inflector\Rules`` e os testes localizados em  
``Doctrine\Tests\Inflector\Rules``.  

Você pode copiar um idioma existente e atualizar as regras conforme o seu idioma.  
Após fazer isso, envie um *pull request* para o repositório  
``doctrine/inflector`` com as adições.

Configuração personalizada
==========================

Se você quiser definir regras personalizadas de singular e plural,  
poderá configurá-las diretamente na *factory*:

.. code-block:: php

    use Doctrine\Inflector\InflectorFactory;
    use Doctrine\Inflector\Rules\Pattern;
    use Doctrine\Inflector\Rules\Patterns;
    use Doctrine\Inflector\Rules\Ruleset;
    use Doctrine\Inflector\Rules\Substitution;
    use Doctrine\Inflector\Rules\Substitutions;
    use Doctrine\Inflector\Rules\Transformation;
    use Doctrine\Inflector\Rules\Transformations;
    use Doctrine\Inflector\Rules\Word;

    $inflector = InflectorFactory::create()
        ->withSingularRules(
            new Ruleset(
                new Transformations(
                    new Transformation(new Pattern('/^(bil)er$/i'), '\1'),
                    new Transformation(new Pattern('/^(inflec|contribu)tors$/i'), '\1ta')
                ),
                new Patterns(new Pattern('singulars')),
                new Substitutions(new Substitution(new Word('spins'), new Word('spinor')))
            )
        )
        ->withPluralRules(
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
        )
        ->build();

Inflector sem operação
----------------------

O ``Doctrine\Inflector\NoopWordInflector`` pode ser usado para configurar  
um inflector que **não realiza nenhuma operação** de pluralização  
ou singularização — ele simplesmente retorna o mesmo valor de entrada.

Essa é uma implementação do padrão de projeto  
`Null Object <https://sourcemaking.com/design_patterns/null_object>`_.

.. code-block:: php

    use Doctrine\Inflector\Inflector;
    use Doctrine\Inflector\NoopWordInflector;

    $inflector = new Inflector(new NoopWordInflector(), new NoopWordInflector());

Tableize
========

Converte ``ModelName`` em ``model_name``:

.. code-block:: php

    echo $inflector->tableize('ModelName'); // model_name

Classify
========

Converte ``model_name`` em ``ModelName``:

.. code-block:: php

    echo $inflector->classify('model_name'); // ModelName

Camelize
========

Este método utiliza `Classify`_ e depois converte o primeiro caractere  
para minúsculo:

.. code-block:: php

    echo $inflector->camelize('model_name'); // modelName

Capitalizar
==========

Recebe uma string e capitaliza todas as palavras, de forma semelhante  
à função nativa do PHP ``ucwords``.  
Entretanto, este método estende esse comportamento permitindo  
configurar os delimitadores de palavras, e não apenas o espaço em branco.

Exemplo:

.. code-block:: php 

    $texto = 'bom-dia para todos_vocês!';

    echo $inflector->capitalize($texto); // Bom-Dia Para Todos_vocês!

    echo $inflector->capitalize($texto, '-_ '); // Bom-Dia Para Todos_Vocês!

Pluralizar
=========

Retorna uma palavra em sua forma plural.

.. code-block:: php

    echo $inflector->pluralize('programação'); // programações

Singularizar
===========

Retorna uma palavra em sua forma singular.

.. code-block:: php

    echo $inflector->singularize('programações'); // programação

Urlizar
======

Gera uma *string* compatível com URLs a partir de um texto:

.. code-block:: php

    echo $inflector->urlize('Meu primeiro post no blog'); // meu-primeiro-post-no-blog

Remover acentuação
==================

Você pode remover acentos de uma *string* usando o método ``unaccent()``:

.. code-block:: php

    echo $inflector->unaccent('mês'); // mes

API legada
==========

A API presente no **Inflector 1.x** ainda está disponível,  
mas será descontinuada em uma versão futura e removida no **3.0**.  
O suporte a idiomas além do inglês está disponível apenas na API **2.0**.

Agradecimentos
================

As regras linguísticas desta biblioteca foram adaptadas de diversas fontes, incluindo:

- `Ruby On Rails Inflector <http://api.rubyonrails.org/classes/ActiveSupport/Inflector.html>`_  
- `ICanBoogie Inflector <https://github.com/ICanBoogie/Inflector>`_  
- `CakePHP Inflector <https://book.cakephp.org/3.0/en/core-libraries/inflector.html>`_
