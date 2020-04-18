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

use BadMethodCallException;
use Doctrine\Inflector\Inflector as InflectorObject;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Language;
use function sprintf;
use function trigger_error;
use const E_USER_DEPRECATED;

/**
 * @deprecated
 */
final class Inflector
{
    /** @var InflectorObject|null */
    private static $instance;

    private static function getInstance() : InflectorObject
    {
        if (self::$instance === null) {
            self::$instance = (new InflectorFactory())(Language::ENGLISH);
        }

        return self::$instance;
    }

    /**
     * Converts a word into the format for a Doctrine table name. Converts 'ModelName' to 'model_name'.
     *
     * @deprecated
     */
    public static function tableize(string $word) : string
    {
        @trigger_error(sprintf('The "%s" method is deprecated and will be dropped in Doctrine Inflector 3.0. Please update to the new Inflector API.', __METHOD__), E_USER_DEPRECATED);

        return self::getInstance()->tableize($word);
    }

    /**
     * Converts a word into the format for a Doctrine class name. Converts 'table_name' to 'TableName'.
     */
    public static function classify(string $word) : string
    {
        @trigger_error(sprintf('The "%s" method is deprecated and will be dropped in Doctrine Inflector 3.0. Please update to the new Inflector API.', __METHOD__), E_USER_DEPRECATED);

        return self::getInstance()->classify($word);
    }

    /**
     * Camelizes a word. This uses the classify() method and turns the first character to lowercase.
     *
     * @deprecated
     */
    public static function camelize(string $word) : string
    {
        @trigger_error(sprintf('The "%s" method is deprecated and will be dropped in Doctrine Inflector 3.0. Please update to the new Inflector API.', __METHOD__), E_USER_DEPRECATED);

        return self::getInstance()->camelize($word);
    }

    /**
     * Uppercases words with configurable delimiters between words.
     *
     * Takes a string and capitalizes all of the words, like PHP's built-in
     * ucwords function. This extends that behavior, however, by allowing the
     * word delimiters to be configured, rather than only separating on
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
     * @return string The string with all delimiter-separated words capitalized.
     *
     * @deprecated
     */
    public static function ucwords(string $string, string $delimiters = " \n\t\r\0\x0B-") : string
    {
        @trigger_error(sprintf('The "%s" method is deprecated and will be dropped in Doctrine Inflector 3.0. Please use the "ucwords" function instead.', __METHOD__), E_USER_DEPRECATED);

        return ucwords($string, $delimiters);
    }

    /**
     * Clears Inflectors inflected value caches, and resets the inflection
     * rules to the initial values.
     *
     * @deprecated
     */
    public static function reset() : void
    {
        @trigger_error(sprintf('The "%s" method is deprecated and will be dropped in Doctrine Inflector 3.0. Please update to the new Inflector API.', __METHOD__), E_USER_DEPRECATED);
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
     * @param string  $type         The type of inflection, either 'plural' or 'singular'
     * @param array|iterable $rules An array of rules to be added.
     * @param boolean $reset        If true, will unset default inflections for all
     *                              new rules that are being defined in $rules.
     *
     * @return void
     *
     * @deprecated
     */
    public static function rules(string $type, iterable $rules, bool $reset = false) : void
    {
        throw new BadMethodCallException('Adding custom rules is no longer supported in Doctrine Inflector 2.0.');
    }

    /**
     * Returns a word in plural form.
     *
     * @param string $word The word in singular form.
     *
     * @return string The word in plural form.
     *
     * @deprecated
     */
    public static function pluralize(string $word) : string
    {
        @trigger_error(sprintf('The "%s" method is deprecated and will be dropped in Doctrine Inflector 3.0. Please update to the new Inflector API.', __METHOD__), E_USER_DEPRECATED);

        return self::getInstance()->pluralize($word);
    }

    /**
     * Returns a word in singular form.
     *
     * @param string $word The word in plural form.
     *
     * @return string The word in singular form.
     *
     * @deprecated
     */
    public static function singularize(string $word) : string
    {
        @trigger_error(sprintf('The "%s" method is deprecated and will be dropped in Doctrine Inflector 3.0. Please update to the new Inflector API.', __METHOD__), E_USER_DEPRECATED);

        return self::getInstance()->singularize($word);
    }
}
