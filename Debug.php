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

namespace Doctrine\Common\Util;

/**
 * Static class containing most used debug methods.
 *
 * @license http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link    www.doctrine-project.org
 * @since   2.0
 * @author  Guilherme Blanco <guilhermeblanco@hotmail.com>
 * @author  Jonathan Wage <jonwage@gmail.com>
 * @author  Roman Borschel <roman@code-factory.org>
 * @author  Giorgio Sironi <piccoloprincipeazzurro@gmail.com>
 */
final class Debug
{
    /**
     * Private constructor (prevents from instantiation)
     *
     */
    private function __construct() {}

    /**
     * Prints a dump of the public, protected and private properties of $var.
     *
     * @link http://xdebug.org/
     * @param mixed $var
     * @param integer $maxDepth Maximum nesting level for object properties
     * @param boolean $stripTags Flag that indicate if output should strip HTML tags
     */
    public static function dump($var, $maxDepth = 2, $stripTags = true)
    {
        ini_set('html_errors', 'On');

        if (extension_loaded('xdebug')) {
            ini_set('xdebug.var_display_max_depth', $maxDepth);
        }

        $var = self::export($var, $maxDepth++);

        ob_start();
        var_dump($var);
        $dump = ob_get_contents();
        ob_end_clean();

        echo ($stripTags ? strip_tags(html_entity_decode($dump)) : $dump);

        ini_set('html_errors', 'Off');
    }

    /**
     * Export
     *
     * @param mixed $var
     * @param int $maxDepth
     * @return mixed
     */
    public static function export($var, $maxDepth)
    {
        $return = null;
        $isObj = is_object($var);

        if ($isObj && in_array('Doctrine\Common\Collections\Collection', class_implements($var))) {
            $var = $var->toArray();
        }

        if ($maxDepth) {
            if (is_array($var)) {
                $return = array();

                foreach ($var as $k => $v) {
                    $return[$k] = self::export($v, $maxDepth - 1);
                }
            } else if ($isObj) {
                $return = new \stdclass();
                if ($var instanceof \DateTime) {
                    $return->__CLASS__ = "DateTime";
                    $return->date = $var->format('c');
                    $return->timezone = $var->getTimeZone()->getName();
                } else {
                    $reflClass = ClassUtils::newReflectionObject($var);
                    $return->__CLASS__ = ClassUtils::getClass($var);

                    if ($var instanceof \Doctrine\Common\Persistence\Proxy) {
                        $return->__IS_PROXY__ = true;
                        $return->__PROXY_INITIALIZED__ = $var->__isInitialized();
                    }

                    foreach ($reflClass->getProperties() as $reflProperty) {
                        $name  = $reflProperty->getName();

                        $reflProperty->setAccessible(true);
                        $return->$name = self::export($reflProperty->getValue($var), $maxDepth - 1);
                    }
                }
            } else {
                $return = $var;
            }
        } else {
            $return = is_object($var) ? get_class($var)
                : (is_array($var) ? 'Array(' . count($var) . ')' : $var);
        }

        return $return;
    }

    /**
     * Convert to string
     *
     * @param object $obj
     * @return string
     */
    public static function toString($obj)
    {
        return method_exists('__toString', $obj) ? (string) $obj : get_class($obj) . '@' . spl_object_hash($obj);
    }
}
