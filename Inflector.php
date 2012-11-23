<?php
/*
 *  $Id: Inflector.php 3189 2007-11-18 20:37:44Z meus $
 *
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

namespace Doctrine\Common\Util;

/**
 * Doctrine inflector has static methods for inflecting text
 *
 * The methods in these classes are from several different sources collected
 * across several different php projects and several different authors. The
 * original author names and emails are not known.
 *
 * Plurialize & Singularize implementation are borrowed from CakePHP with some modifications.
 *
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.doctrine-project.org
 * @since       1.0
 * @version     $Revision: 3189 $
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 * @author      Jonathan H. Wage <jonwage@gmail.com>
 */
class Inflector
{
    /**
     * Convert word in to the format for a Doctrine table name. Converts 'ModelName' to 'model_name'
     *
     * @param  string $word  Word to tableize
     * @return string $word  Tableized word
     */
    public static function tableize($word)
    {
        return strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $word));
    }

    /**
     * Convert a word in to the format for a Doctrine class name. Converts 'table_name' to 'TableName'
     *
     * @param string  $word  Word to classify
     * @return string $word  Classified word
     */
    public static function classify($word)
    {
        return str_replace(" ", "", ucwords(strtr($word, "_-", "  ")));
    }

    /**
     * Camelize a word. This uses the classify() method and turns the first character to lowercase
     *
     * @param string $word
     * @return string $word
     */
    public static function camelize($word)
    {
        return lcfirst(self::classify($word));
    }

    /**
     * Plural inflector rules
     *
     * @var array
     */
    protected static $_plural = array(
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
            '/(buffal|tomat)o$/i' => '\1\2oes',
            '/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|vir)us$/i' => '\1i',
            '/us$/i' => 'uses',
            '/(alias)$/i' => '\1es',
            '/(ax|cris|test)is$/i' => '\1es',
            '/s$/' => 's',
            '/^$/' => '',
            '/$/' => 's',
        ),
        'uninflected' => array(
            '.*[nrlm]ese', '.*deer', '.*fish', '.*measles', '.*ois', '.*pox', '.*sheep', 'people', 'cookie'
        ),
        'irregular' => array(
            'atlas' => 'atlases',
            'beef' => 'beefs',
            'brother' => 'brothers',
            'cafe' => 'cafes',
            'child' => 'children',
            'cookie' => 'cookies',
            'corpus' => 'corpuses',
            'cow' => 'cows',
            'ganglion' => 'ganglions',
            'genie' => 'genies',
            'genus' => 'genera',
            'graffito' => 'graffiti',
            'hoof' => 'hoofs',
            'loaf' => 'loaves',
            'man' => 'men',
            'money' => 'monies',
            'mongoose' => 'mongooses',
            'move' => 'moves',
            'mythos' => 'mythoi',
            'niche' => 'niches',
            'numen' => 'numina',
            'occiput' => 'occiputs',
            'octopus' => 'octopuses',
            'opus' => 'opuses',
            'ox' => 'oxen',
            'penis' => 'penises',
            'person' => 'people',
            'sex' => 'sexes',
            'soliloquy' => 'soliloquies',
            'testis' => 'testes',
            'trilby' => 'trilbys',
            'turf' => 'turfs'
        )
    );

    /**
     * Singular inflector rules
     *
     * @var array
     */
    protected static $_singular = array(
        'rules' => array(
            '/(s)tatuses$/i' => '\1\2tatus',
            '/^(.*)(menu)s$/i' => '\1\2',
            '/(quiz)zes$/i' => '\\1',
            '/(matr)ices$/i' => '\1ix',
            '/(vert|ind)ices$/i' => '\1ex',
            '/^(ox)en/i' => '\1',
            '/(alias)(es)*$/i' => '\1',
            '/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|viri?)i$/i' => '\1us',
            '/([ftw]ax)es/i' => '\1',
            '/(cris|ax|test)es$/i' => '\1is',
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
            '/(n)ews$/i' => '\1\2ews',
            '/eaus$/' => 'eau',
            '/^(.*us)$/' => '\\1',
            '/s$/i' => ''
        ),
        'uninflected' => array(
            '.*[nrlm]ese', '.*deer', '.*fish', '.*measles', '.*ois', '.*pox', '.*sheep', '.*ss'
        ),
        'irregular' => array(
            'foes' => 'foe',
            'waves' => 'wave',
            'curves' => 'curve'
        )
    );

    /**
     * Words that should not be inflected
     *
     * @var array
     */
    protected static $_uninflected = array(
        'Amoyese', 'bison', 'Borghese', 'bream', 'breeches', 'britches', 'buffalo', 'cantus',
        'carp', 'chassis', 'clippers', 'cod', 'coitus', 'Congoese', 'contretemps', 'corps',
        'debris', 'diabetes', 'djinn', 'eland', 'elk', 'equipment', 'Faroese', 'flounder',
        'Foochowese', 'gallows', 'Genevese', 'Genoese', 'Gilbertese', 'graffiti',
        'headquarters', 'herpes', 'hijinks', 'Hottentotese', 'information', 'innings',
        'jackanapes', 'Kiplingese', 'Kongoese', 'Lucchese', 'mackerel', 'Maltese', '.*?media',
        'mews', 'moose', 'mumps', 'Nankingese', 'news', 'nexus', 'Niasese',
        'Pekingese', 'Piedmontese', 'pincers', 'Pistoiese', 'pliers', 'Portuguese',
        'proceedings', 'rabies', 'rice', 'rhinoceros', 'salmon', 'Sarawakese', 'scissors',
        'sea[- ]bass', 'series', 'Shavese', 'shears', 'siemens', 'species', 'swine', 'testes',
        'trousers', 'trout', 'tuna', 'Vermontese', 'Wenchowese', 'whiting', 'wildebeest',
        'Yengeese'
    );

    /**
     * Method cache array.
     *
     * @var array
     */
    protected static $_cache = array();

    /**
     * The initial state of Inflector so reset() works.
     *
     * @var array
     */
    protected static $_initialState = array();

    /**
     * Cache inflected values, and return if already available
     *
     * @param string $type Inflection type
     * @param string $key Original value
     * @param string $value Inflected value
     * @return string Inflected value, from cache
     */
    protected static function _cache($type, $key, $value = false) {
        $key = '_' . $key;
        $type = '_' . $type;
        if ($value !== false) {
            self::$_cache[$type][$key] = $value;
            return $value;
        }
        if (!isset(self::$_cache[$type][$key])) {
            return false;
        }
        return self::$_cache[$type][$key];
    }

    /**
     * Clears Inflectors inflected value caches. And resets the inflection
     * rules to the initial values.
     *
     * @return void
     */
    public static function reset() {
        if (empty(self::$_initialState)) {
            self::$_initialState = get_class_vars('Inflector');
            return;
        }
        foreach (self::$_initialState as $key => $val) {
            if ($key != '_initialState') {
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
     * @param string $type The type of inflection, either 'plural' or 'singular'
     * @param array $rules Array of rules to be added.
     * @param boolean $reset If true, will unset default inflections for all
     *        new rules that are being defined in $rules.
     * @return void
     */
    public static function rules($type, $rules, $reset = false) {
        $var = '_' . $type;

        foreach ($rules as $rule => $pattern) {
            if (is_array($pattern)) {
                if ($reset) {
                    self::${$var}[$rule] = $pattern;
                } else {
                    if ($rule === 'uninflected') {
                        self::${$var}[$rule] = array_merge($pattern, self::${$var}[$rule]);
                    } else {
                        self::${$var}[$rule] = $pattern + self::${$var}[$rule];
                    }
                }
                unset($rules[$rule], self::${$var}['cache' . ucfirst($rule)]);
                if (isset(self::${$var}['merged'][$rule])) {
                    unset(self::${$var}['merged'][$rule]);
                }
                if ($type === 'plural') {
                    self::$_cache['pluralize'] = self::$_cache['tableize'] = array();
                } elseif ($type === 'singular') {
                    self::$_cache['singularize'] = array();
                }
            }
        }
        self::${$var}['rules'] = $rules + self::${$var}['rules'];
    }

    /**
     * Return $word in plural form.
     *
     * @param string $word Word in singular
     * @return string Word in plural
     */
    public static function pluralize($word) {
        if (isset(self::$_cache['pluralize'][$word])) {
            return self::$_cache['pluralize'][$word];
        }

        if (!isset(self::$_plural['merged']['irregular'])) {
            self::$_plural['merged']['irregular'] = self::$_plural['irregular'];
        }

        if (!isset(self::$_plural['merged']['uninflected'])) {
            self::$_plural['merged']['uninflected'] = array_merge(self::$_plural['uninflected'], self::$_uninflected);
        }

        if (!isset(self::$_plural['cacheUninflected']) || !isset(self::$_plural['cacheIrregular'])) {
            self::$_plural['cacheUninflected'] = '(?:' . implode('|', self::$_plural['merged']['uninflected']) . ')';
            self::$_plural['cacheIrregular'] = '(?:' . implode('|', array_keys(self::$_plural['merged']['irregular'])) . ')';
        }

        if (preg_match('/(.*)\\b(' . self::$_plural['cacheIrregular'] . ')$/i', $word, $regs)) {
            self::$_cache['pluralize'][$word] = $regs[1] . substr($word, 0, 1) . substr(self::$_plural['merged']['irregular'][strtolower($regs[2])], 1);
            return self::$_cache['pluralize'][$word];
        }

        if (preg_match('/^(' . self::$_plural['cacheUninflected'] . ')$/i', $word, $regs)) {
            self::$_cache['pluralize'][$word] = $word;
            return $word;
        }

        foreach (self::$_plural['rules'] as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                self::$_cache['pluralize'][$word] = preg_replace($rule, $replacement, $word);
                return self::$_cache['pluralize'][$word];
            }
        }
    }

    /**
     * Return $word in singular form.
     *
     * @param string $word Word in plural
     * @return string Word in singular
     */
    public static function singularize($word) {
        if (isset(self::$_cache['singularize'][$word])) {
            return self::$_cache['singularize'][$word];
        }

        if (!isset(self::$_singular['merged']['uninflected'])) {
            self::$_singular['merged']['uninflected'] = array_merge(
                self::$_singular['uninflected'],
                self::$_uninflected
            );
        }

        if (!isset(self::$_singular['merged']['irregular'])) {
            self::$_singular['merged']['irregular'] = array_merge(
                self::$_singular['irregular'],
                array_flip(self::$_plural['irregular'])
            );
        }

        if (!isset(self::$_singular['cacheUninflected']) || !isset(self::$_singular['cacheIrregular'])) {
            self::$_singular['cacheUninflected'] = '(?:' . join('|', self::$_singular['merged']['uninflected']) . ')';
            self::$_singular['cacheIrregular'] = '(?:' . join('|', array_keys(self::$_singular['merged']['irregular'])) . ')';
        }

        if (preg_match('/(.*)\\b(' . self::$_singular['cacheIrregular'] . ')$/i', $word, $regs)) {
            self::$_cache['singularize'][$word] = $regs[1] . substr($word, 0, 1) . substr(self::$_singular['merged']['irregular'][strtolower($regs[2])], 1);
            return self::$_cache['singularize'][$word];
        }

        if (preg_match('/^(' . self::$_singular['cacheUninflected'] . ')$/i', $word, $regs)) {
            self::$_cache['singularize'][$word] = $word;
            return $word;
        }

        foreach (self::$_singular['rules'] as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                self::$_cache['singularize'][$word] = preg_replace($rule, $replacement, $word);
                return self::$_cache['singularize'][$word];
            }
        }
        self::$_cache['singularize'][$word] = $word;
        return $word;
    }
}

Inflector::reset();