<?php

namespace Doctrine\Tests\Common\Inflector;

use Doctrine\Tests\DoctrineTestCase;
use Doctrine\Common\Inflector\Inflector;

class InflectorTest extends DoctrineTestCase
{
    /**
     * Singular & Plural test data. Returns an array of sample words.
     *
     * @return array
     */ 
    public function dataSampleWords() 
    {
        Inflector::reset();
        
        // in the format array('singular', 'plural') 
        return array(
            array('categoria', 'categorias'),
            array('house', 'houses'),
            array('powerhouse', 'powerhouses'),
            array('Bus', 'Buses'),
            array('bus', 'buses'),
            array('menu', 'menus'),
            array('news', 'news'),
            array('food_menu', 'food_menus'),
            array('Menu', 'Menus'),
            array('FoodMenu', 'FoodMenus'),
            array('quiz', 'quizzes'),
            array('matrix_row', 'matrix_rows'),
            array('matrix', 'matrices'),
            array('vertex', 'vertices'),
            array('index', 'indices'),
            array('Alias', 'Aliases'),
            array('Media', 'Media'),
            array('NodeMedia', 'NodeMedia'),
            array('alumnus', 'alumni'),
            array('bacillus', 'bacilli'),
            array('cactus', 'cacti'),
            array('focus', 'foci'),
            array('fungus', 'fungi'),
            array('nucleus', 'nuclei'),
            array('octopus', 'octopuses'),
            array('radius', 'radii'),
            array('stimulus', 'stimuli'),
            array('syllabus', 'syllabi'),
            array('terminus', 'termini'),
            array('virus', 'viri'),
            array('person', 'people'),
            array('glove', 'gloves'),
            array('crisis', 'crises'),
            array('tax', 'taxes'),
            array('wave', 'waves'),
            array('bureau', 'bureaus'),
            array('cafe', 'cafes'),
            array('roof', 'roofs'),
            array('foe', 'foes'),
            array('cookie', 'cookies'),
            array('identity', 'identities'),
            array('criteria', 'criterion'),
            array('curve', 'curves'),
            array('', ''),
        );
    }

    /**
     * testInflectingSingulars method
     *
     * @dataProvider dataSampleWords
     * @return void
     */
    public function testInflectingSingulars($singular, $plural) 
    {
        $this->assertEquals(
            $singular, 
            Inflector::singularize($plural), 
            "'$plural' should be singularized to '$singular'"
        );
    }

    /**
     * testInflectingPlurals method
     *
     * @dataProvider dataSampleWords
     * @return void
     */
    public function testInflectingPlurals($singular, $plural) 
    {
        $this->assertEquals(
            $plural, 
            Inflector::pluralize($singular), 
            "'$singular' should be pluralized to '$plural'"
        );
    }

    /**
     * testCustomPluralRule method
     *
     * @return void
     */
    public function testCustomPluralRule() 
    {
        Inflector::reset();
        Inflector::rules('plural', array('/^(custom)$/i' => '\1izables'));
        
        $this->assertEquals(Inflector::pluralize('custom'), 'customizables');

        Inflector::rules('plural', array('uninflected' => array('uninflectable')));
        
        $this->assertEquals(Inflector::pluralize('uninflectable'), 'uninflectable');

        Inflector::rules('plural', array(
            'rules' => array('/^(alert)$/i' => '\1ables'),
            'uninflected' => array('noflect', 'abtuse'),
            'irregular' => array('amaze' => 'amazable', 'phone' => 'phonezes')
        ));
        
        $this->assertEquals(Inflector::pluralize('noflect'), 'noflect');
        $this->assertEquals(Inflector::pluralize('abtuse'), 'abtuse');
        $this->assertEquals(Inflector::pluralize('alert'), 'alertables');
        $this->assertEquals(Inflector::pluralize('amaze'), 'amazable');
        $this->assertEquals(Inflector::pluralize('phone'), 'phonezes');
    }

    /**
     * testCustomSingularRule method
     *
     * @return void
     */
    public function testCustomSingularRule() 
    {
        Inflector::reset();
        Inflector::rules('singular', array('/(eple)r$/i' => '\1', '/(jente)r$/i' => '\1'));

        $this->assertEquals(Inflector::singularize('epler'), 'eple');
        $this->assertEquals(Inflector::singularize('jenter'), 'jente');

        Inflector::rules('singular', array(
            'rules' => array('/^(bil)er$/i' => '\1', '/^(inflec|contribu)tors$/i' => '\1ta'),
            'uninflected' => array('singulars'),
            'irregular' => array('spins' => 'spinor')
        ));

        $this->assertEquals(Inflector::singularize('inflectors'), 'inflecta');
        $this->assertEquals(Inflector::singularize('contributors'), 'contributa');
        $this->assertEquals(Inflector::singularize('spins'), 'spinor');
        $this->assertEquals(Inflector::singularize('singulars'), 'singulars');
    }

    /**
     * test that setting new rules clears the inflector caches.
     *
     * @return void
     */
    public function testRulesClearsCaches() 
    {
        Inflector::reset();
        
        $this->assertEquals(Inflector::singularize('Bananas'), 'Banana');
        $this->assertEquals(Inflector::pluralize('Banana'), 'Bananas');

        Inflector::rules('singular', array(
            'rules' => array('/(.*)nas$/i' => '\1zzz')
        ));
        
        $this->assertEquals('Banazzz', Inflector::singularize('Bananas'), 'Was inflected with old rules.');

        Inflector::rules('plural', array(
            'rules' => array('/(.*)na$/i' => '\1zzz'),
            'irregular' => array('corpus' => 'corpora')
        ));
        
        $this->assertEquals(Inflector::pluralize('Banana'), 'Banazzz', 'Was inflected with old rules.');
        $this->assertEquals(Inflector::pluralize('corpus'), 'corpora', 'Was inflected with old irregular form.');
    }

    /**
     * Test resetting inflection rules.
     *
     * @return void
     */
    public function testCustomRuleWithReset() 
    {
        Inflector::reset();
        
        $uninflected = array('atlas', 'lapis', 'onibus', 'pires', 'virus', '.*x');
        $pluralIrregular = array('as' => 'ases');

        Inflector::rules('singular', array(
            'rules' => array('/^(.*)(a|e|o|u)is$/i' => '\1\2l'),
            'uninflected' => $uninflected,
        ), true);

        Inflector::rules('plural', array(
            'rules' => array(
                '/^(.*)(a|e|o|u)l$/i' => '\1\2is',
            ),
            'uninflected' => $uninflected,
            'irregular' => $pluralIrregular
        ), true);

        $this->assertEquals(Inflector::pluralize('Alcool'), 'Alcoois');
        $this->assertEquals(Inflector::pluralize('Atlas'), 'Atlas');
        $this->assertEquals(Inflector::singularize('Alcoois'), 'Alcool');
        $this->assertEquals(Inflector::singularize('Atlas'), 'Atlas');
    }
}

