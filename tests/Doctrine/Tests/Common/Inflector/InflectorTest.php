<?php

namespace Doctrine\Tests\Common\Inflector;

use Doctrine\Common\Inflector\Inflector;
use PHPUnit\Framework\TestCase;
use function sprintf;

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
        return [
            ['', ''],
            ['Abuse', 'Abuses'],
            ['AcceptanceCriterion', 'AcceptanceCriteria'],
            ['Alias', 'Aliases'],
            ['alumnus', 'alumni'],
            ['analysis', 'analyses'],
            ['aquarium', 'aquaria'],
            ['arch', 'arches'],
            ['atlas', 'atlases'],
            ['avalanche', 'avalanches'],
            ['axe', 'axes'],
            ['baby', 'babies'],
            ['bacillus', 'bacilli'],
            ['bacterium', 'bacteria'],
            ['bureau', 'bureaus'],
            ['bus', 'buses'],
            ['Bus', 'Buses'],
            ['cache', 'caches'],
            ['cactus', 'cacti'],
            ['cafe', 'cafes'],
            ['calf', 'calves'],
            ['categoria', 'categorias'],
            ['chateau', 'chateaux'],
            ['cherry', 'cherries'],
            ['child', 'children'],
            ['church', 'churches'],
            ['circus', 'circuses'],
            ['city', 'cities'],
            ['cod', 'cod'],
            ['cookie', 'cookies'],
            ['copy', 'copies'],
            ['crisis', 'crises'],
            ['criterion', 'criteria'],
            ['curriculum', 'curricula'],
            ['curve', 'curves'],
            ['data', 'data'],
            ['deer', 'deer'],
            ['demo', 'demos'],
            ['dictionary', 'dictionaries'],
            ['domino', 'dominoes'],
            ['dwarf', 'dwarves'],
            ['echo', 'echoes'],
            ['elf', 'elves'],
            ['emphasis', 'emphases'],
            ['family', 'families'],
            ['fax', 'faxes'],
            ['fish', 'fish'],
            ['flush', 'flushes'],
            ['fly', 'flies'],
            ['focus', 'foci'],
            ['foe', 'foes'],
            ['food_menu', 'food_menus'],
            ['FoodMenu', 'FoodMenus'],
            ['foot', 'feet'],
            ['fungus', 'fungi'],
            ['goose', 'geese'],
            ['glove', 'gloves'],
            ['gulf', 'gulfs'],
            ['grave', 'graves'],
            ['half', 'halves'],
            ['hero', 'heroes'],
            ['hippopotamus', 'hippopotami'],
            ['hoax', 'hoaxes'],
            ['house', 'houses'],
            ['human', 'humans'],
            ['identity', 'identities'],
            ['index', 'indices'],
            ['iris', 'irises'],
            ['kiss', 'kisses'],
            ['knife', 'knives'],
            ['larva', 'larvae'],
            ['leaf', 'leaves'],
            ['life', 'lives'],
            ['loaf', 'loaves'],
            ['man', 'men'],
            ['matrix', 'matrices'],
            ['matrix_row', 'matrix_rows'],
            ['medium', 'media'],
            ['memorandum', 'memoranda'],
            ['menu', 'menus'],
            ['Menu', 'Menus'],
            ['mess', 'messes'],
            ['moose', 'moose'],
            ['motto', 'mottoes'],
            ['mouse', 'mice'],
            ['neurosis', 'neuroses'],
            ['news', 'news'],
            ['niveau', 'niveaux'],
            ['NodeMedia', 'NodeMedia'],
            ['nucleus', 'nuclei'],
            ['oasis', 'oases'],
            ['octopus', 'octopuses'],
            ['pass', 'passes'],
            ['passerby', 'passersby'],
            ['person', 'people'],
            ['plateau', 'plateaux'],
            ['potato', 'potatoes'],
            ['powerhouse', 'powerhouses'],
            ['quiz', 'quizzes'],
            ['radius', 'radii'],
            ['reflex', 'reflexes'],
            ['roof', 'roofs'],
            ['runner-up', 'runners-up'],
            ['safe', 'safes'],
            ['save', 'saves'],
            ['scarf', 'scarves'],
            ['scratch', 'scratches'],
            ['series', 'series'],
            ['sheep', 'sheep'],
            ['shelf', 'shelves'],
            ['shoe', 'shoes'],
            ['son-in-law', 'sons-in-law'],
            ['species', 'species'],
            ['splash', 'splashes'],
            ['spouse', 'spouses'],
            ['spy', 'spies'],
            ['stimulus', 'stimuli'],
            ['stitch', 'stitches'],
            ['story', 'stories'],
            ['syllabus', 'syllabi'],
            ['tax', 'taxes'],
            ['terminus', 'termini'],
            ['thesis', 'theses'],
            ['thief', 'thieves'],
            ['tomato', 'tomatoes'],
            ['tooth', 'teeth'],
            ['tornado', 'tornadoes'],
            ['try', 'tries'],
            ['vertex', 'vertices'],
            ['virus', 'viri'],
            ['valve', 'valves'],
            ['volcano', 'volcanoes'],
            ['wash', 'washes'],
            ['watch', 'watches'],
            ['wave', 'waves'],
            ['wharf', 'wharves'],
            ['wife', 'wives'],
            ['woman', 'women'],
            ['clothes', 'clothes'],
            ['pants', 'pants'],
            ['police', 'police'],
            ['scissors', 'scissors'],
            ['trousers', 'trousers'],
            ['dive', 'dives'],
            ['olive', 'olives'],
            // Uninflected words possibly not defined under singular/plural rules
            ['Amoyese', 'Amoyese'],
            ['audio', 'audio'],
            ['bison', 'bison'],
            ['Borghese', 'Borghese'],
            ['bream', 'bream'],
            ['breeches', 'breeches'],
            ['britches', 'britches'],
            ['buffalo', 'buffalo'],
            ['cantus', 'cantus'],
            ['carp', 'carp'],
            ['chassis', 'chassis'],
            ['clippers', 'clippers'],
            ['cod', 'cod'],
            ['coitus', 'coitus'],
            ['compensation', 'compensation'],
            ['Congoese', 'Congoese'],
            ['contretemps', 'contretemps'],
            ['coreopsis', 'coreopsis'],
            ['corps', 'corps'],
            ['data', 'data'],
            ['debris', 'debris'],
            ['deer', 'deer'],
            ['diabetes', 'diabetes'],
            ['djinn', 'djinn'],
            ['education', 'education'],
            ['eland', 'eland'],
            ['elk', 'elk'],
            ['emoji', 'emoji'],
            ['equipment', 'equipment'],
            ['evidence', 'evidence'],
            ['Faroese', 'Faroese'],
            ['feedback', 'feedback'],
            ['fish', 'fish'],
            ['flounder', 'flounder'],
            ['Foochowese', 'Foochowese'],
            ['Furniture', 'Furniture'],
            ['furniture', 'furniture'],
            ['gallows', 'gallows'],
            ['Genevese', 'Genevese'],
            ['Genoese', 'Genoese'],
            ['Gilbertese', 'Gilbertese'],
            ['gold', 'gold'],
            ['headquarters', 'headquarters'],
            ['herpes', 'herpes'],
            ['hijinks', 'hijinks'],
            ['Hottentotese', 'Hottentotese'],
            ['information', 'information'],
            ['innings', 'innings'],
            ['jackanapes', 'jackanapes'],
            ['jedi', 'jedi'],
            ['Kiplingese', 'Kiplingese'],
            ['knowledge', 'knowledge'],
            ['Kongoese', 'Kongoese'],
            ['love', 'love'],
            ['Lucchese', 'Lucchese'],
            ['Luggage', 'Luggage'],
            ['mackerel', 'mackerel'],
            ['Maltese', 'Maltese'],
            ['metadata', 'metadata'],
            ['mews', 'mews'],
            ['moose', 'moose'],
            ['mumps', 'mumps'],
            ['Nankingese', 'Nankingese'],
            ['news', 'news'],
            ['nexus', 'nexus'],
            ['Niasese', 'Niasese'],
            ['nutrition', 'nutrition'],
            ['offspring', 'offspring'],
            ['Pekingese', 'Pekingese'],
            ['Piedmontese', 'Piedmontese'],
            ['pincers', 'pincers'],
            ['Pistoiese', 'Pistoiese'],
            ['plankton', 'plankton'],
            ['pliers', 'pliers'],
            ['pokemon', 'pokemon'],
            ['police', 'police'],
            ['Portuguese', 'Portuguese'],
            ['proceedings', 'proceedings'],
            ['rabies', 'rabies'],
            ['rain', 'rain'],
            ['rhinoceros', 'rhinoceros'],
            ['rice', 'rice'],
            ['salmon', 'salmon'],
            ['Sarawakese', 'Sarawakese'],
            ['scissors', 'scissors'],
            ['series', 'series'],
            ['Shavese', 'Shavese'],
            ['shears', 'shears'],
            ['sheep', 'sheep'],
            ['siemens', 'siemens'],
            ['species', 'species'],
            ['staff', 'staff'],
            ['swine', 'swine'],
            ['traffic', 'traffic'],
            ['trousers', 'trousers'],
            ['trout', 'trout'],
            ['tuna', 'tuna'],
            ['us', 'us'],
            ['Vermontese', 'Vermontese'],
            ['Wenchowese', 'Wenchowese'],
            ['wheat', 'wheat'],
            ['whiting', 'whiting'],
            ['wildebeest', 'wildebeest'],
            ['Yengeese', 'Yengeese'],
            [ 'middleware', 'middleware' ],
            // Regex uninflected words
            ['sea bass', 'sea bass'],
            ['sea-bass', 'sea-bass'],
        ];
    }

    /**
     * @dataProvider dataSampleWords
     */
    public function testInflectingSingulars(string $singular, string $plural) : void
    {
        $this->assertEquals(
            $singular,
            Inflector::singularize($plural),
            sprintf("'%s' should be singularized to '%s'", $plural, $singular)
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
            sprintf("'%s' should be pluralized to '%s'", $singular, $plural)
        );
    }

    public function testCustomPluralRule() : void
    {
        Inflector::reset();
        Inflector::rules('plural', ['/^(custom)$/i' => '\1izables']);

        $this->assertEquals(Inflector::pluralize('custom'), 'customizables');

        Inflector::rules('plural', ['uninflected' => ['uninflectable']]);

        $this->assertEquals(Inflector::pluralize('uninflectable'), 'uninflectable');

        Inflector::rules('plural', [
            'rules' => ['/^(alert)$/i' => '\1ables'],
            'uninflected' => ['noflect', 'abtuse'],
            'irregular' => ['amaze' => 'amazable', 'phone' => 'phonezes'],
        ]);

        $this->assertEquals(Inflector::pluralize('noflect'), 'noflect');
        $this->assertEquals(Inflector::pluralize('abtuse'), 'abtuse');
        $this->assertEquals(Inflector::pluralize('alert'), 'alertables');
        $this->assertEquals(Inflector::pluralize('amaze'), 'amazable');
        $this->assertEquals(Inflector::pluralize('phone'), 'phonezes');
    }

    public function testCustomSingularRule() : void
    {
        Inflector::reset();
        Inflector::rules('singular', ['/(eple)r$/i' => '\1', '/(jente)r$/i' => '\1']);

        $this->assertEquals(Inflector::singularize('epler'), 'eple');
        $this->assertEquals(Inflector::singularize('jenter'), 'jente');

        Inflector::rules('singular', [
            'rules' => ['/^(bil)er$/i' => '\1', '/^(inflec|contribu)tors$/i' => '\1ta'],
            'uninflected' => ['singulars'],
            'irregular' => ['spins' => 'spinor'],
        ]);

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

        Inflector::rules('singular', [
            'rules' => ['/(.*)nas$/i' => '\1zzz'],
        ]);

        $this->assertEquals('Banazzz', Inflector::singularize('Bananas'), 'Was inflected with old rules.');

        Inflector::rules('plural', [
            'rules' => ['/(.*)na$/i' => '\1zzz'],
            'irregular' => ['corpus' => 'corpora'],
        ]);

        $this->assertEquals(Inflector::pluralize('Banana'), 'Banazzz', 'Was inflected with old rules.');
        $this->assertEquals(Inflector::pluralize('corpus'), 'corpora', 'Was inflected with old irregular form.');
    }

    public function testCustomRuleWithReset() : void
    {
        Inflector::reset();

        $uninflected     = ['atlas', 'lapis', 'onibus', 'pires', 'virus', '.*x'];
        $pluralIrregular = ['as' => 'ases'];

        Inflector::rules('singular', [
            'rules' => ['/^(.*)(a|e|o|u)is$/i' => '\1\2l'],
            'uninflected' => $uninflected,
        ], true);

        Inflector::rules('plural', [
            'rules' => ['/^(.*)(a|e|o|u)l$/i' => '\1\2is'],
            'uninflected' => $uninflected,
            'irregular' => $pluralIrregular,
        ], true);

        $this->assertEquals(Inflector::pluralize('Alcool'), 'Alcoois');
        $this->assertEquals(Inflector::pluralize('Atlas'), 'Atlas');
        $this->assertEquals(Inflector::singularize('Alcoois'), 'Alcool');
        $this->assertEquals(Inflector::singularize('Atlas'), 'Atlas');
    }

    public function testUcwords() : void
    {
        $this->assertSame('Top-O-The-Morning To All_of_you!', Inflector::ucwords('top-o-the-morning to all_of_you!'));
    }

    public function testUcwordsWithCustomDelimiters() : void
    {
        $this->assertSame('Top-O-The-Morning To All_Of_You!', Inflector::ucwords('top-o-the-morning to all_of_you!', '-_ '));
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
        return [
            ['', ''],
            ['foo_bar', 'FooBar'],
            ['f0o_bar', 'F0oBar'],
        ];
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
        return [
            ['', ''],
            ['FooBar', 'foo_bar'],
            ['FooBar', 'foo bar'],
            ['F0oBar', 'f0o bar'],
            ['F0oBar', 'f0o  bar'],
            ['FooBar', 'foo_bar_'],
        ];
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
        return [
            ['', ''],
            ['fooBar', 'foo_bar'],
            ['fooBar', 'foo bar'],
            ['f0oBar', 'f0o bar'],
            ['f0oBar', 'f0o  bar'],
        ];
    }
}
