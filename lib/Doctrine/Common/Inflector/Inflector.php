<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\Common\Inflector;

/**
 * Doctrine inflector has static methods for inflecting text.
 *
 * The methods in these classes are from several different sources collected
 * across several different php projects and several different authors. The
 * original author names and emails are not known.
 *
 * Pluralize & Singularize implementation are borrowed from CakePHP with some modifications.
 *
 * @link   www.doctrine-project.org
 * @since  1.0
 * @author Konsta Vesterinen <kvesteri@cc.hut.fi>
 * @author Jonathan H. Wage <jonwage@gmail.com>
 */
class Inflector
{
    /**
     * Plural inflector rules.
     *
     * @var array
     */
    private static $plural = array(
        'rules' => array(
            '/(s)tatus$/i' => '\1\2tatuses',
            '/(quiz)$/i' => '\1zes',
            '/^(ox)$/i' => '\1\2en',
            '/([m|l])ouse$/i' => '\1ice',
            '/(matr|vert|ind)(ix|ex)$/i' => '\1ices',
            '/(x|ch|ss|sh)$/i' => '\1es',
            '/([^aeiouy]|qu)y$/i' => '\1ies',
            '/(hive)$/i' => '\1s',
            '/(?:([^f])fe|([lr])f)$/i' => '\1\2ves',
            '/sis$/i' => 'ses',
            '/([ti])um$/i' => '\1a',
            '/(p)erson$/i' => '\1eople',
            '/(m)an$/i' => '\1en',
            '/(c)hild$/i' => '\1hildren',
            '/(f)oot$/i' => '\1eet',
            '/(buffal|her|potat|tomat|volcan)o$/i' => '\1\2oes',
            '/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|vir)us$/i' => '\1i',
            '/us$/i' => 'uses',
            '/(alias)$/i' => '\1es',
            '/(analys|ax|cris|test|thes)is$/i' => '\1es',
            '/s$/' => 's',
            '/^$/' => '',
            '/$/' => 's',
        ),
        'uninflected' => array(
            '.*[nrlm]ese', '.*deer', '.*fish', '.*measles', '.*ois', '.*pox', '.*sheep', 'people', 'cookie'
        ),
        'irregular' => array(
            'atlas' => 'atlases',
            'axe' => 'axes',
            'beef' => 'beefs',
            'brother' => 'brothers',
            'cafe' => 'cafes',
            'chateau' => 'chateaux',
            'child' => 'children',
            'cookie' => 'cookies',
            'corpus' => 'corpuses',
            'cow' => 'cows',
            'criterion' => 'criteria',
            'curriculum' => 'curricula',
            'demo' => 'demos',
            'domino' => 'dominoes',
            'echo' => 'echoes',
            'foot' => 'feet',
            'fungus' => 'fungi',
            'ganglion' => 'ganglions',
            'genie' => 'genies',
            'genus' => 'genera',
            'graffito' => 'graffiti',
            'hippopotamus' => 'hippopotami',
            'hoof' => 'hoofs',
            'human' => 'humans',
            'iris' => 'irises',
            'leaf' => 'leaves',
            'loaf' => 'loaves',
            'man' => 'men',
            'medium' => 'media',
            'memorandum' => 'memoranda',
            'money' => 'monies',
            'mongoose' => 'mongooses',
            'motto' => 'mottoes',
            'move' => 'moves',
            'mythos' => 'mythoi',
            'niche' => 'niches',
            'nucleus' => 'nuclei',
            'numen' => 'numina',
            'occiput' => 'occiputs',
            'octopus' => 'octopuses',
            'opus' => 'opuses',
            'ox' => 'oxen',
            'penis' => 'penises',
            'person' => 'people',
            'plateau' => 'plateaux',
            'runner-up' => 'runners-up',
            'sex' => 'sexes',
            'soliloquy' => 'soliloquies',
            'son-in-law' => 'sons-in-law',
            'syllabus' => 'syllabi',
            'testis' => 'testes',
            'thief' => 'thieves',
            'tooth' => 'teeth',
            'tornado' => 'tornadoes',
            'trilby' => 'trilbys',
            'turf' => 'turfs',
            'volcano' => 'volcanoes',
        )
    );

    /**
     * Singular inflector rules.
     *
     * @var array
     */
    private static $singular = array(
        'rules' => array(
            '/(s)tatuses$/i' => '\1\2tatus',
            '/^(.*)(menu)s$/i' => '\1\2',
            '/(quiz)zes$/i' => '\\1',
            '/(matr)ices$/i' => '\1ix',
            '/(vert|ind)ices$/i' => '\1ex',
            '/^(ox)en/i' => '\1',
            '/(alias)(es)*$/i' => '\1',
            '/(buffal|her|potat|tomat|volcan)oes$/i' => '\1o',
            '/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|viri?)i$/i' => '\1us',
            '/([ftw]ax)es/i' => '\1',
            '/(analys|ax|cris|test|thes)es$/i' => '\1is',
            '/(shoe|slave)s$/i' => '\1',
            '/(o)es$/i' => '\1',
            '/ouses$/' => 'ouse',
            '/([^a])uses$/' => '\1us',
            '/([m|l])ice$/i' => '\1ouse',
            '/(x|ch|ss|sh)es$/i' => '\1',
            '/(m)ovies$/i' => '\1\2ovie',
            '/(s)eries$/i' => '\1\2eries',
            '/([^aeiouy]|qu)ies$/i' => '\1y',
            '/([lr])ves$/i' => '\1f',
            '/(tive)s$/i' => '\1',
            '/(hive)s$/i' => '\1',
            '/(drive)s$/i' => '\1',
            '/([^fo])ves$/i' => '\1fe',
            '/(^analy)ses$/i' => '\1sis',
            '/(analy|diagno|^ba|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\1\2sis',
            '/([ti])a$/i' => '\1um',
            '/(p)eople$/i' => '\1\2erson',
            '/(m)en$/i' => '\1an',
            '/(c)hildren$/i' => '\1\2hild',
            '/(f)eet$/i' => '\1oot',
            '/(n)ews$/i' => '\1\2ews',
            '/eaus$/' => 'eau',
            '/^(.*us)$/' => '\\1',
            '/s$/i' => '',
        ),
        'uninflected' => array(
            '.*[nrlm]ese',
            '.*deer',
            '.*fish',
            '.*measles',
            '.*ois',
            '.*pox',
            '.*sheep',
            '.*ss',
        ),
        'irregular' => array(
            'criteria'  => 'criterion',
            'curves'    => 'curve',
            'emphases'  => 'emphasis',
            'foes'      => 'foe',
            'hoaxes'    => 'hoax',
            'media'     => 'medium',
            'neuroses'  => 'neurosis',
            'waves'     => 'wave',
            'oases'     => 'oasis',
        )
    );

    /**
     * Words that should not be inflected.
     *
     * @var array
     */
    private static $uninflected = array(
        'Amoyese', 'bison', 'Borghese', 'bream', 'breeches', 'britches', 'buffalo', 'cantus',
        'carp', 'chassis', 'clippers', 'cod', 'coitus', 'Congoese', 'contretemps', 'corps',
        'debris', 'diabetes', 'djinn', 'eland', 'elk', 'equipment', 'Faroese', 'flounder',
        'Foochowese', 'gallows', 'Genevese', 'Genoese', 'Gilbertese', 'graffiti',
        'headquarters', 'herpes', 'hijinks', 'Hottentotese', 'information', 'innings',
        'jackanapes', 'Kiplingese', 'Kongoese', 'Lucchese', 'mackerel', 'Maltese', '.*?media',
        'mews', 'moose', 'mumps', 'Nankingese', 'news', 'nexus', 'Niasese',
        'Pekingese', 'Piedmontese', 'pincers', 'Pistoiese', 'pliers', 'Portuguese',
        'proceedings', 'rabies', 'rice', 'rhinoceros', 'salmon', 'Sarawakese', 'scissors',
        'sea[- ]bass', 'series', 'Shavese', 'shears', 'siemens', 'species', 'staff', 'swine',
        'testes', 'trousers', 'trout', 'tuna', 'Vermontese', 'Wenchowese', 'whiting',
        'wildebeest', 'Yengeese'
    );

    /**
     * Method cache array.
     *
     * @var array
     */
    private static $cache = array();

    /**
     * The initial state of Inflector so reset() works.
     *
     * @var array
     */
    private static $initialState = array();

    /**
     * Converts a word into the format for a Doctrine table name. Converts 'ModelName' to 'model_name'.
     *
     * @param string $word The word to tableize.
     *
     * @return string The tableized word.
     */
    public static function tableize($word)
    {
        return strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $word));
    }

    /**
     * Converts a word into the format for a Doctrine class name. Converts 'table_name' to 'TableName'.
     *
     * @param string $word The word to classify.
     *
     * @return string The classified word.
     */
    public static function classify($word)
    {
        if ((!defined('HHVM_VERSION_ID') || HHVM_VERSION_ID >= 31200) && (PHP_VERSION_ID >= 50516 || (PHP_VERSION_ID < 50500 && PHP_VERSION_ID >= 50432))) {
            return str_replace(array(' ', '_', '-'), '', ucwords($word, ' _-'));
        }

        return str_replace(' ', '', ucwords(strtr($word, '_-', '  ')));
    }

    /**
     * Camelizes a word. This uses the classify() method and turns the first character to lowercase.
     *
     * @param string $word The word to camelize.
     *
     * @return string The camelized word.
     */
    public static function camelize($word)
    {
        return lcfirst(self::classify($word));
    }

    /**
     * Uppercases words with configurable delimeters between words.
     *
     * Takes a string and capitalizes all of the words, like PHP's built-in
     * ucwords function. This extends that behavior, however, by allowing the
     * word delimeters to be configured, rather than only separating on
     * whitespace.
     *
     * Here is an example:
     * <code>
     * <?php
     * $string = 'top-o-the-morning to all_of_you!';
     * echo \Doctrine\Common\Inflector\Inflector::ucwords($string);
     * // Top-O-The-Morning To All_of_you!
     *
     * echo \Doctrine\Common\Inflector\Inflector::ucwords($string, '-_ ');
     * // Top-O-The-Morning To All_Of_You!
     * ?>
     * </code>
     *
     * @param string $string The string to operate on.
     * @param string $delimiters A list of word separators.
     *
     * @return string The string with all delimeter-separated words capitalized.
     */
    public static function ucwords($string, $delimiters = " \n\t\r\0\x0B-")
    {
        if ((!defined('HHVM_VERSION_ID') || HHVM_VERSION_ID >= 31200) && (PHP_VERSION_ID >= 50516 || (PHP_VERSION_ID < 50500 && PHP_VERSION_ID >= 50432))) {
            return ucwords($string, $delimiters);
        }

        return preg_replace_callback(
            '/[^' . preg_quote($delimiters, '/') . ']+/',
            function($matches) {
                return ucfirst($matches[0]);
            },
            $string
        );
    }

    /**
     * Clears Inflectors inflected value caches, and resets the inflection
     * rules to the initial values.
     *
     * @return void
     */
    public static function reset()
    {
        if (empty(self::$initialState)) {
            self::$initialState = get_class_vars('Inflector');

            return;
        }

        foreach (self::$initialState as $key => $val) {
            if ('initialState' !== $key) {
                self::${$key} = $val;
            }
        }
    }

    /**
     * Adds custom inflection $rules, of either 'plural' or 'singular' $type.
     *
     * ### Usage:
     *
     * {{{
     * Inflector::rules('plural', array('/^(inflect)or$/i' => '\1ables'));
     * Inflector::rules('plural', array(
     *     'rules' => array('/^(inflect)ors$/i' => '\1ables'),
     *     'uninflected' => array('dontinflectme'),
     *     'irregular' => array('red' => 'redlings')
     * ));
     * }}}
     *
     * @param string  $type  The type of inflection, either 'plural' or 'singular'
     * @param array   $rules An array of rules to be added.
     * @param boolean $reset If true, will unset default inflections for all
     *                       new rules that are being defined in $rules.
     *
     * @return void
     */
    public static function rules($type, $rules, $reset = false)
    {
        foreach ($rules as $rule => $pattern) {
            if ( ! is_array($pattern)) {
                continue;
            }

            if ($reset) {
                self::${$type}[$rule] = $pattern;
            } else {
                self::${$type}[$rule] = ('uninflected' === $rule)
                    ? array_merge($pattern, self::${$type}[$rule])
                    : $pattern + self::${$type}[$rule];
            }

            unset($rules[$rule], self::${$type}['cache' . ucfirst($rule)]);

            if (isset(self::${$type}['merged'][$rule])) {
                unset(self::${$type}['merged'][$rule]);
            }

            if ('plural' === $type) {
                self::$cache['pluralize'] = self::$cache['tableize'] = array();
            } elseif ('singular' === $type) {
                self::$cache['singularize'] = array();
            }
        }

        self::${$type}['rules'] = $rules + self::${$type}['rules'];
    }

    /**
     * Returns a word in plural form.
     *
     * @param string $word The word in singular form.
     *
     * @return string The word in plural form.
     */
    public static function pluralize($word)
    {
        if (isset(self::$cache['pluralize'][$word])) {
            return self::$cache['pluralize'][$word];
        }

        if (!isset(self::$plural['merged']['irregular'])) {
            self::$plural['merged']['irregular'] = self::$plural['irregular'];
        }

        if (!isset(self::$plural['merged']['uninflected'])) {
            self::$plural['merged']['uninflected'] = array_merge(self::$plural['uninflected'], self::$uninflected);
        }

        if (!isset(self::$plural['cacheUninflected']) || !isset(self::$plural['cacheIrregular'])) {
            self::$plural['cacheUninflected'] = '(?:' . implode('|', self::$plural['merged']['uninflected']) . ')';
            self::$plural['cacheIrregular']   = '(?:' . implode('|', array_keys(self::$plural['merged']['irregular'])) . ')';
        }

        if (preg_match('/(.*)\\b(' . self::$plural['cacheIrregular'] . ')$/i', $word, $regs)) {
            self::$cache['pluralize'][$word] = $regs[1] . substr($word, 0, 1) . substr(self::$plural['merged']['irregular'][strtolower($regs[2])], 1);

            return self::$cache['pluralize'][$word];
        }

        if (preg_match('/^(' . self::$plural['cacheUninflected'] . ')$/i', $word, $regs)) {
            self::$cache['pluralize'][$word] = $word;

            return $word;
        }

        foreach (self::$plural['rules'] as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                self::$cache['pluralize'][$word] = preg_replace($rule, $replacement, $word);

                return self::$cache['pluralize'][$word];
            }
        }
    }

    /**
     * Returns a word in singular form.
     *
     * @param string $word The word in plural form.
     *
     * @return string The word in singular form.
     */
    public static function singularize($word)
    {
        if (isset(self::$cache['singularize'][$word])) {
            return self::$cache['singularize'][$word];
        }

        if (!isset(self::$singular['merged']['uninflected'])) {
            self::$singular['merged']['uninflected'] = array_merge(
                self::$singular['uninflected'],
                self::$uninflected
            );
        }

        if (!isset(self::$singular['merged']['irregular'])) {
            self::$singular['merged']['irregular'] = array_merge(
                self::$singular['irregular'],
                array_flip(self::$plural['irregular'])
            );
        }

        if (!isset(self::$singular['cacheUninflected']) || !isset(self::$singular['cacheIrregular'])) {
            self::$singular['cacheUninflected'] = '(?:' . join('|', self::$singular['merged']['uninflected']) . ')';
            self::$singular['cacheIrregular'] = '(?:' . join('|', array_keys(self::$singular['merged']['irregular'])) . ')';
        }

        if (preg_match('/(.*)\\b(' . self::$singular['cacheIrregular'] . ')$/i', $word, $regs)) {
            self::$cache['singularize'][$word] = $regs[1] . substr($word, 0, 1) . substr(self::$singular['merged']['irregular'][strtolower($regs[2])], 1);

            return self::$cache['singularize'][$word];
        }

        if (preg_match('/^(' . self::$singular['cacheUninflected'] . ')$/i', $word, $regs)) {
            self::$cache['singularize'][$word] = $word;

            return $word;
        }

        foreach (self::$singular['rules'] as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                self::$cache['singularize'][$word] = preg_replace($rule, $replacement, $word);

                return self::$cache['singularize'][$word];
            }
        }

        self::$cache['singularize'][$word] = $word;

        return $word;
    }
}
