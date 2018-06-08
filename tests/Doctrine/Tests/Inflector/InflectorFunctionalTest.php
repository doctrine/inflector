<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Rules\Irregular;
use Doctrine\Inflector\Rules\Rule;
use Doctrine\Inflector\Rules\Rules;
use Doctrine\Inflector\Rules\Uninflected;
use Doctrine\Inflector\Rules\Word;
use PHPUnit\Framework\TestCase;
use function sprintf;

class InflectorFunctionalTest extends TestCase
{
    /** @var InflectorFactory */
    private $inflectorFactory;

    /**
     * Singular & Plural test data. Returns an array of sample words.
     *
     * @return string[][]
     */
    public function dataSampleWords() : array
    {
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
            ['taxon', 'taxa'],
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
        self::assertSame(
            $singular,
            $this->createInflector()->singularize($plural),
            sprintf("'%s' should be singularized to '%s'", $plural, $singular)
        );
    }

    /**
     * @dataProvider dataSampleWords
     */
    public function testInflectingPlurals(string $singular, string $plural) : void
    {
        self::assertSame(
            $plural,
            $this->createInflector()->pluralize($singular),
            sprintf("'%s' should be pluralized to '%s'", $singular, $plural)
        );
    }

    public function testCustomPluralRule() : void
    {
        $inflector = $this->inflectorFactory->createInflector(
            $this->inflectorFactory->createSingularRuleset(),
            $this->inflectorFactory->createPluralRuleset(
                new Rules(new Rule('/^(custom)$/i', '\1izables'))
            )
        );

        self::assertSame($inflector->pluralize('custom'), 'customizables');
    }

    public function testCustomPluralRuleUninflected() : void
    {
        $inflector = $this->inflectorFactory->createInflector(
            $this->inflectorFactory->createSingularRuleset(),
            $this->inflectorFactory->createPluralRuleset(
                null,
                new Uninflected(new Word('uninflectable'))
            )
        );

        self::assertSame($inflector->pluralize('uninflectable'), 'uninflectable');
    }

    public function testCustomPluralRules() : void
    {
        $inflector = $this->inflectorFactory->createInflector(
            $this->inflectorFactory->createSingularRuleset(),
            $this->inflectorFactory->createPluralRuleset(
                new Rules(new Rule('/^(alert)$/i', '\1ables')),
                new Uninflected(new Word('noflect'), new Word('abtuse')),
                new Irregular(
                    new Rule('amaze', 'amazable'),
                    new Rule('phone', 'phonezes')
                )
            )
        );

        self::assertSame($inflector->pluralize('noflect'), 'noflect');
        self::assertSame($inflector->pluralize('abtuse'), 'abtuse');
        self::assertSame($inflector->pluralize('alert'), 'alertables');
        self::assertSame($inflector->pluralize('amaze'), 'amazable');
        self::assertSame($inflector->pluralize('phone'), 'phonezes');
    }

    public function testCustomSingularRule() : void
    {
        $inflector = $this->inflectorFactory->createInflector(
            $this->inflectorFactory->createSingularRuleset(
                new Rules(
                    new Rule('/(eple)r$/i', '\1'),
                    new Rule('/(jente)r$/i', '\1')
                )
            ),
            $this->inflectorFactory->createPluralRuleset()
        );

        self::assertSame($inflector->singularize('epler'), 'eple');
        self::assertSame($inflector->singularize('jenter'), 'jente');
    }

    public function testCustomSingularRules() : void
    {
        $inflector = $this->inflectorFactory->createInflector(
            $this->inflectorFactory->createSingularRuleset(
                new Rules(
                    new Rule('/^(bil)er$/i', '\1'),
                    new Rule('/^(inflec|contribu)tors$/i', '\1ta')
                ),
                new Uninflected(new Word('singulars')),
                new Irregular(new Rule('spins', 'spinor'))
            ),
            $this->inflectorFactory->createPluralRuleset()
        );

        self::assertSame($inflector->singularize('inflectors'), 'inflecta');
        self::assertSame($inflector->singularize('contributors'), 'contributa');
        self::assertSame($inflector->singularize('spins'), 'spinor');
        self::assertSame($inflector->singularize('singulars'), 'singulars');
    }

    public function testCapitalize() : void
    {
        self::assertSame(
            'Top-O-The-Morning To All_of_you!',
            $this->createInflector()->capitalize('top-o-the-morning to all_of_you!')
        );
    }

    public function testCapitalizeWithCustomDelimiters() : void
    {
        self::assertSame(
            'Top-O-The-Morning To All_Of_You!',
            $this->createInflector()->capitalize('top-o-the-morning to all_of_you!', '-_ ')
        );
    }

    /**
     * @dataProvider dataStringsTableize
     */
    public function testTableize(string $expected, string $word) : void
    {
        self::assertSame($expected, $this->createInflector()->tableize($word));
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
        self::assertSame($expected, $this->createInflector()->classify($word));
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
        self::assertSame($expected, $this->createInflector()->camelize($word));
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

    protected function setUp() : void
    {
        $this->inflectorFactory = new InflectorFactory();
    }

    private function createInflector() : Inflector
    {
        return $this->inflectorFactory->createInflector();
    }
}
