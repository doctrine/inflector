<?php

namespace Doctrine\Tests\Common\Inflector;

use Doctrine\Common\Inflector\Inflector;
use PHPUnit\Framework\TestCase;

class InflectorTest extends TestCase
{
    /**
     * Singular & Plural test data. Returns an array of sample words.
     *
     * @return string[][]
     */
    public function dataSampleWords() : array
    {
        Inflector::reset();

        // In the format array('singular', 'plural')
        return array(
            array('', ''),
            array('Abuse', 'Abuses'),
            array('AcceptanceCriterion', 'AcceptanceCriteria'),
            array('Alias', 'Aliases'),
            array('alumnus', 'alumni'),
            array('analysis', 'analyses'),
            array('aquarium', 'aquaria'),
            array('arch', 'arches'),
            array('atlas', 'atlases'),
            array('avalanche', 'avalanches'),
            array('axe', 'axes'),
            array('baby', 'babies'),
            array('bacillus', 'bacilli'),
            array('bacterium', 'bacteria'),
            array('bureau', 'bureaus'),
            array('bus', 'buses'),
            array('Bus', 'Buses'),
            array('cache', 'caches'),
            array('cactus', 'cacti'),
            array('cafe', 'cafes'),
            array('calf', 'calves'),
            array('canvas', 'canvases'),
            array('categoria', 'categorias'),
            array('chateau', 'chateaux'),
            array('cherry', 'cherries'),
            array('child', 'children'),
            array('church', 'churches'),
            array('circus', 'circuses'),
            array('city', 'cities'),
            array('cod', 'cod'),
            array('cookie', 'cookies'),
            array('copy', 'copies'),
            array('crisis', 'crises'),
            array('criterion', 'criteria'),
            array('curriculum', 'curricula'),
            array('curve', 'curves'),
            array('data', 'data'),
            array('deer', 'deer'),
            array('demo', 'demos'),
            array('dictionary', 'dictionaries'),
            array('domino', 'dominoes'),
            array('dwarf', 'dwarves'),
            array('echo', 'echoes'),
            array('elf', 'elves'),
            array('emphasis', 'emphases'),
            array('family', 'families'),
            array('fax', 'faxes'),
            array('fish', 'fish'),
            array('flush', 'flushes'),
            array('fly', 'flies'),
            array('focus', 'foci'),
            array('foe', 'foes'),
            array('food_menu', 'food_menus'),
            array('FoodMenu', 'FoodMenus'),
            array('foot', 'feet'),
            array('fungus', 'fungi'),
            array('gas', 'gases'),
            array('goose', 'geese'),
            array('glove', 'gloves'),
            array('gulf', 'gulfs'),
            array('grave', 'graves'),
            array('half', 'halves'),
            array('hero', 'heroes'),
            array('hippopotamus', 'hippopotami'),
            array('hoax', 'hoaxes'),
            array('house', 'houses'),
            array('human', 'humans'),
            array('identity', 'identities'),
            array('index', 'indices'),
            array('iris', 'irises'),
            array('kiss', 'kisses'),
            array('knife', 'knives'),
            array('larva', 'larvae'),
            array('leaf', 'leaves'),
            array('life', 'lives'),
            array('loaf', 'loaves'),
            array('man', 'men'),
            array('matrix', 'matrices'),
            array('matrix_row', 'matrix_rows'),
            array('medium', 'media'),
            array('memorandum', 'memoranda'),
            array('menu', 'menus'),
            array('Menu', 'Menus'),
            array('mess', 'messes'),
            array('moose', 'moose'),
            array('motto', 'mottoes'),
            array('mouse', 'mice'),
            array('neurosis', 'neuroses'),
            array('news', 'news'),
            array('niveau', 'niveaux'),
            array('NodeMedia', 'NodeMedia'),
            array('nucleus', 'nuclei'),
            array('oasis', 'oases'),
            array('octopus', 'octopuses'),
            array('pass', 'passes'),
            array('passerby', 'passersby'),
            array('person', 'people'),
            array('plateau', 'plateaux'),
            array('potato', 'potatoes'),
            array('powerhouse', 'powerhouses'),
            array('quiz', 'quizzes'),
            array('radius', 'radii'),
            array('reflex', 'reflexes'),
            array('roof', 'roofs'),
            array('runner-up', 'runners-up'),
            array('scarf', 'scarves'),
            array('scratch', 'scratches'),
            array('series', 'series'),
            array('sheep', 'sheep'),
            array('shelf', 'shelves'),
            array('shoe', 'shoes'),
            array('son-in-law', 'sons-in-law'),
            array('species', 'species'),
            array('splash', 'splashes'),
            array('spouse', 'spouses'),
            array('spy', 'spies'),
            array('stimulus', 'stimuli'),
            array('stitch', 'stitches'),
            array('story', 'stories'),
            array('syllabus', 'syllabi'),
            array('tax', 'taxes'),
            array('terminus', 'termini'),
            array('thesis', 'theses'),
            array('thief', 'thieves'),
            array('tomato', 'tomatoes'),
            array('tooth', 'teeth'),
            array('tornado', 'tornadoes'),
            array('try', 'tries'),
            array('vertex', 'vertices'),
            array('virus', 'viri'),
            array('valve', 'valves'),
            array('volcano', 'volcanoes'),
            array('wash', 'washes'),
            array('watch', 'watches'),
            array('wave', 'waves'),
            array('wharf', 'wharves'),
            array('wife', 'wives'),
            array('woman', 'women'),
            array('clothes', 'clothes'),
            array('pants', 'pants'),
            array('police', 'police'),
            array('scissors', 'scissors'),
            array('trousers', 'trousers'),
            array('dive', 'dives'),
            array('olive', 'olives'),
            // Uninflected words possibly not defined under singular/plural rules
            array("Amoyese", "Amoyese"),
            array("audio", "audio"),
            array("bison", "bison"),
            array("Borghese", "Borghese"),
            array("bream", "bream"),
            array("breeches", "breeches"),
            array("britches", "britches"),
            array("buffalo", "buffalo"),
            array("cantus", "cantus"),
            array("carp", "carp"),
            array("chassis", "chassis"),
            array("clippers", "clippers"),
            array("cod", "cod"),
            array("coitus", "coitus"),
            array("compensation", "compensation"),
            array("Congoese", "Congoese"),
            array("contretemps", "contretemps"),
            array("coreopsis", "coreopsis"),
            array("corps", "corps"),
            array("data", "data"),
            array("debris", "debris"),
            array("deer", "deer"),
            array("diabetes", "diabetes"),
            array("djinn", "djinn"),
            array("education", "education"),
            array("eland", "eland"),
            array("elk", "elk"),
            array("emoji", "emoji"),
            array("equipment", "equipment"),
            array("evidence", "evidence"),
            array("Faroese", "Faroese"),
            array("feedback", "feedback"),
            array("fish", "fish"),
            array("flounder", "flounder"),
            array("Foochowese", "Foochowese"),
            array("Furniture", "Furniture"),
            array("furniture", "furniture"),
            array("gallows", "gallows"),
            array("Genevese", "Genevese"),
            array("Genoese", "Genoese"),
            array("Gilbertese", "Gilbertese"),
            array("gold", "gold"),
            array("headquarters", "headquarters"),
            array("herpes", "herpes"),
            array("hijinks", "hijinks"),
            array("Hottentotese", "Hottentotese"),
            array("information", "information"),
            array("innings", "innings"),
            array("jackanapes", "jackanapes"),
            array("jedi", "jedi"),
            array("Kiplingese", "Kiplingese"),
            array("knowledge", "knowledge"),
            array("Kongoese", "Kongoese"),
            array("love", "love"),
            array("Lucchese", "Lucchese"),
            array("Luggage", "Luggage"),
            array("mackerel", "mackerel"),
            array("Maltese", "Maltese"),
            array("metadata", "metadata"),
            array("mews", "mews"),
            array("moose", "moose"),
            array("mumps", "mumps"),
            array("Nankingese", "Nankingese"),
            array("news", "news"),
            array("nexus", "nexus"),
            array("Niasese", "Niasese"),
            array("nutrition", "nutrition"),
            array("offspring", "offspring"),
            array("Pekingese", "Pekingese"),
            array("Piedmontese", "Piedmontese"),
            array("pincers", "pincers"),
            array("Pistoiese", "Pistoiese"),
            array("plankton", "plankton"),
            array("pliers", "pliers"),
            array("pokemon", "pokemon"),
            array("police", "police"),
            array("Portuguese", "Portuguese"),
            array("proceedings", "proceedings"),
            array("rabies", "rabies"),
            array("rain", "rain"),
            array("rhinoceros", "rhinoceros"),
            array("rice", "rice"),
            array("salmon", "salmon"),
            array("Sarawakese", "Sarawakese"),
            array("scissors", "scissors"),
            array("series", "series"),
            array("Shavese", "Shavese"),
            array("shears", "shears"),
            array("sheep", "sheep"),
            array("siemens", "siemens"),
            array("species", "species"),
            array("staff", "staff"),
            array("swine", "swine"),
            array("traffic", "traffic"),
            array("trousers", "trousers"),
            array("trout", "trout"),
            array("tuna", "tuna"),
            array("us", "us"),
            array("Vermontese", "Vermontese"),
            array("Wenchowese", "Wenchowese"),
            array("wheat", "wheat"),
            array("whiting", "whiting"),
            array("wildebeest", "wildebeest"),
            array("Yengeese", "Yengeese"),
            // Regex uninflected words
            array("sea bass", "sea bass"),
            array("sea-bass", "sea-bass"),                                                                                    
        );
    }

    /**
     * @dataProvider dataSampleWords
     */
    public function testInflectingSingulars(string $singular, string $plural) : void
    {
        $this->assertEquals(
            $singular,
            Inflector::singularize($plural),
            "'$plural' should be singularized to '$singular'"
        );
    }

    /**
     * @dataProvider dataSampleWords
     */
    public function testInflectingPlurals(string $singular, string $plural) : void
    {
        $this->assertEquals(
            $plural,
            Inflector::pluralize($singular),
            "'$singular' should be pluralized to '$plural'"
        );
    }

    public function testCustomPluralRule() : void
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

    public function testCustomSingularRule() : void
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

    public function testSettingNewRulesClearsCaches() : void
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

    public function testCustomRuleWithReset() : void
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

    public function testUcwords() : void
    {
        $this->assertSame('Top-O-The-Morning To All_of_you!', Inflector::ucwords( 'top-o-the-morning to all_of_you!'));
    }

    public function testUcwordsWithCustomDelimiters() : void
    {
        $this->assertSame('Top-O-The-Morning To All_Of_You!', Inflector::ucwords( 'top-o-the-morning to all_of_you!', '-_ '));
    }

    /**
     * @dataProvider dataStringsTableize
     */
    public function testTableize(string $expected, string $word) : void
    {
        $this->assertSame($expected, Inflector::tableize($word));
    }

    /**
     * Strings which are used for testTableize.
     *
     * @return string[][]
     */
    public function dataStringsTableize() : array
    {
        // In the format array('expected', 'word')
        return array(
            array('', ''),
            array('foo_bar', 'FooBar'),
            array('f0o_bar', 'F0oBar'),
        );
    }

    /**
     * @dataProvider dataStringsClassify
     */
    public function testClassify(string $expected, string $word) : void
    {
        $this->assertSame($expected, Inflector::classify($word));
    }

    /**
     * Strings which are used for testClassify.
     *
     * @return string[][]
     */
    public function dataStringsClassify() : array
    {
        // In the format array('expected', 'word')
        return array(
            array('', ''),
            array('FooBar', 'foo_bar'),
            array('FooBar', 'foo bar'),
            array('F0oBar', 'f0o bar'),
            array('F0oBar', 'f0o  bar'),
            array('FooBar', 'foo_bar_'),
        );
    }

    /**
     * @dataProvider dataStringsCamelize
     */
    public function testCamelize(string $expected, string $word) : void
    {
        $this->assertSame($expected, Inflector::camelize($word));
    }

    /**
     * Strings which are used for testCamelize.
     *
     * @return string[][]
     */
    public function dataStringsCamelize() : array
    {
        // In the format array('expected', 'word')
        return array(
            array('', ''),
            array('fooBar', 'foo_bar'),
            array('fooBar', 'foo bar'),
            array('f0oBar', 'f0o bar'),
            array('f0oBar', 'f0o  bar'),
        );
    }
}
