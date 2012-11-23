<?php

namespace Doctrine\Tests\Common\Util
{
    use Doctrine\Tests\DoctrineTestCase;
    use Doctrine\Common\Util\Inflector;

    class InflectorTest extends DoctrineTestCase
    {
        /**
         * testInflectingSingulars method
         *
         * @return void
         */
        public function testInflectingSingulars() {
            Inflector::reset();
            $this->assertEquals(Inflector::singularize('categorias'), 'categoria');
            $this->assertEquals(Inflector::singularize('menus'), 'menu');
            $this->assertEquals(Inflector::singularize('news'), 'news');
            $this->assertEquals(Inflector::singularize('food_menus'), 'food_menu');
            $this->assertEquals(Inflector::singularize('Menus'), 'Menu');
            $this->assertEquals(Inflector::singularize('FoodMenus'), 'FoodMenu');
            $this->assertEquals(Inflector::singularize('houses'), 'house');
            $this->assertEquals(Inflector::singularize('powerhouses'), 'powerhouse');
            $this->assertEquals(Inflector::singularize('quizzes'), 'quiz');
            $this->assertEquals(Inflector::singularize('Buses'), 'Bus');
            $this->assertEquals(Inflector::singularize('buses'), 'bus');
            $this->assertEquals(Inflector::singularize('matrix_rows'), 'matrix_row');
            $this->assertEquals(Inflector::singularize('matrices'), 'matrix');
            $this->assertEquals(Inflector::singularize('vertices'), 'vertex');
            $this->assertEquals(Inflector::singularize('indices'), 'index');
            $this->assertEquals(Inflector::singularize('Aliases'), 'Alias');
            $this->assertEquals(Inflector::singularize('Alias'), 'Alias');
            $this->assertEquals(Inflector::singularize('Media'), 'Media');
            $this->assertEquals(Inflector::singularize('NodeMedia'), 'NodeMedia');
            $this->assertEquals(Inflector::singularize('alumni'), 'alumnus');
            $this->assertEquals(Inflector::singularize('bacilli'), 'bacillus');
            $this->assertEquals(Inflector::singularize('cacti'), 'cactus');
            $this->assertEquals(Inflector::singularize('foci'), 'focus');
            $this->assertEquals(Inflector::singularize('fungi'), 'fungus');
            $this->assertEquals(Inflector::singularize('nuclei'), 'nucleus');
            $this->assertEquals(Inflector::singularize('octopuses'), 'octopus');
            $this->assertEquals(Inflector::singularize('radii'), 'radius');
            $this->assertEquals(Inflector::singularize('stimuli'), 'stimulus');
            $this->assertEquals(Inflector::singularize('syllabi'), 'syllabus');
            $this->assertEquals(Inflector::singularize('termini'), 'terminus');
            $this->assertEquals(Inflector::singularize('viri'), 'virus');
            $this->assertEquals(Inflector::singularize('people'), 'person');
            $this->assertEquals(Inflector::singularize('gloves'), 'glove');
            $this->assertEquals(Inflector::singularize('doves'), 'dove');
            $this->assertEquals(Inflector::singularize('lives'), 'life');
            $this->assertEquals(Inflector::singularize('knives'), 'knife');
            $this->assertEquals(Inflector::singularize('wolves'), 'wolf');
            $this->assertEquals(Inflector::singularize('slaves'), 'slave');
            $this->assertEquals(Inflector::singularize('shelves'), 'shelf');
            $this->assertEquals(Inflector::singularize('taxis'), 'taxi');
            $this->assertEquals(Inflector::singularize('taxes'), 'tax');
            $this->assertEquals(Inflector::singularize('Taxes'), 'Tax');
            $this->assertEquals(Inflector::singularize('AwesomeTaxes'), 'AwesomeTax');
            $this->assertEquals(Inflector::singularize('faxes'), 'fax');
            $this->assertEquals(Inflector::singularize('waxes'), 'wax');
            $this->assertEquals(Inflector::singularize('niches'), 'niche');
            $this->assertEquals(Inflector::singularize('waves'), 'wave');
            $this->assertEquals(Inflector::singularize('bureaus'), 'bureau');
            $this->assertEquals(Inflector::singularize('genetic_analyses'), 'genetic_analysis');
            $this->assertEquals(Inflector::singularize('doctor_diagnoses'), 'doctor_diagnosis');
            $this->assertEquals(Inflector::singularize('parantheses'), 'paranthesis');
            $this->assertEquals(Inflector::singularize('Causes'), 'Cause');
            $this->assertEquals(Inflector::singularize('colossuses'), 'colossus');
            $this->assertEquals(Inflector::singularize('diagnoses'), 'diagnosis');
            $this->assertEquals(Inflector::singularize('bases'), 'basis');
            $this->assertEquals(Inflector::singularize('analyses'), 'analysis');
            $this->assertEquals(Inflector::singularize('curves'), 'curve');
            $this->assertEquals(Inflector::singularize('cafes'), 'cafe');
            $this->assertEquals(Inflector::singularize('roofs'), 'roof');
            $this->assertEquals(Inflector::singularize('foes'), 'foe');
            $this->assertEquals(Inflector::singularize('databases'), 'database');
            $this->assertEquals(Inflector::singularize('cookies'), 'cookie');
            $this->assertEquals(Inflector::singularize(''), '');
        }

        /**
         * testInflectingPlurals method
         *
         * @return void
         */
        public function testInflectingPlurals() {
            Inflector::reset();
            $this->assertEquals(Inflector::pluralize('categoria'), 'categorias');
            $this->assertEquals(Inflector::pluralize('house'), 'houses');
            $this->assertEquals(Inflector::pluralize('powerhouse'), 'powerhouses');
            $this->assertEquals(Inflector::pluralize('Bus'), 'Buses');
            $this->assertEquals(Inflector::pluralize('bus'), 'buses');
            $this->assertEquals(Inflector::pluralize('menu'), 'menus');
            $this->assertEquals(Inflector::pluralize('news'), 'news');
            $this->assertEquals(Inflector::pluralize('food_menu'), 'food_menus');
            $this->assertEquals(Inflector::pluralize('Menu'), 'Menus');
            $this->assertEquals(Inflector::pluralize('FoodMenu'), 'FoodMenus');
            $this->assertEquals(Inflector::pluralize('quiz'), 'quizzes');
            $this->assertEquals(Inflector::pluralize('matrix_row'), 'matrix_rows');
            $this->assertEquals(Inflector::pluralize('matrix'), 'matrices');
            $this->assertEquals(Inflector::pluralize('vertex'), 'vertices');
            $this->assertEquals(Inflector::pluralize('index'), 'indices');
            $this->assertEquals(Inflector::pluralize('Alias'), 'Aliases');
            $this->assertEquals(Inflector::pluralize('Aliases'), 'Aliases');
            $this->assertEquals(Inflector::pluralize('Media'), 'Media');
            $this->assertEquals(Inflector::pluralize('NodeMedia'), 'NodeMedia');
            $this->assertEquals(Inflector::pluralize('alumnus'), 'alumni');
            $this->assertEquals(Inflector::pluralize('bacillus'), 'bacilli');
            $this->assertEquals(Inflector::pluralize('cactus'), 'cacti');
            $this->assertEquals(Inflector::pluralize('focus'), 'foci');
            $this->assertEquals(Inflector::pluralize('fungus'), 'fungi');
            $this->assertEquals(Inflector::pluralize('nucleus'), 'nuclei');
            $this->assertEquals(Inflector::pluralize('octopus'), 'octopuses');
            $this->assertEquals(Inflector::pluralize('radius'), 'radii');
            $this->assertEquals(Inflector::pluralize('stimulus'), 'stimuli');
            $this->assertEquals(Inflector::pluralize('syllabus'), 'syllabi');
            $this->assertEquals(Inflector::pluralize('terminus'), 'termini');
            $this->assertEquals(Inflector::pluralize('virus'), 'viri');
            $this->assertEquals(Inflector::pluralize('person'), 'people');
            $this->assertEquals(Inflector::pluralize('people'), 'people');
            $this->assertEquals(Inflector::pluralize('glove'), 'gloves');
            $this->assertEquals(Inflector::pluralize('crisis'), 'crises');
            $this->assertEquals(Inflector::pluralize('tax'), 'taxes');
            $this->assertEquals(Inflector::pluralize('wave'), 'waves');
            $this->assertEquals(Inflector::pluralize('bureau'), 'bureaus');
            $this->assertEquals(Inflector::pluralize('cafe'), 'cafes');
            $this->assertEquals(Inflector::pluralize('roof'), 'roofs');
            $this->assertEquals(Inflector::pluralize('foe'), 'foes');
            $this->assertEquals(Inflector::pluralize('cookie'), 'cookies');
            $this->assertEquals(Inflector::pluralize(''), '');
        }

        /**
         * testCustomPluralRule method
         *
         * @return void
         */
        public function testCustomPluralRule() {
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
        public function testCustomSingularRule() {
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
        public function testRulesClearsCaches() {
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
        public function testCustomRuleWithReset() {
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
}

