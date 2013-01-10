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

use Doctrine\Common\Persistence\Proxy;

/**
 * Class and reflection related functionality for objects that
 * might or not be proxy objects at the moment.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 * @author Johannes Schmitt <schmittjoh@gmail.com>
 */
class ClassUtils
{
    /**
     * Get the real class name of a class name that could be a proxy.
     *
     * @param string
     * @return string
     */
    public static function getRealClass($class)
    {
        if (false === $pos = strrpos($class, '\\'.Proxy::MARKER.'\\')) {
            return $class;
        }

        return substr($class, $pos + Proxy::MARKER_LENGTH + 2);
    }

    /**
     * Get the real class name of an object (even if its a proxy)
     *
     * @param object
     * @return string
     */
    public static function getClass($object)
    {
        return self::getRealClass(get_class($object));
    }

    /**
     * Get the real parent class name of a class or object
     *
     * @param string
     * @return string
     */
    public static function getParentClass($className)
    {
        return get_parent_class( self::getRealClass( $className ) );
    }

    /**
     * Create a new reflection class
     *
     * @param string
     * @return \ReflectionClass
     */
    public static function newReflectionClass($class)
    {
        return new \ReflectionClass( self::getRealClass( $class ) );
    }

    /**
     * Create a new reflection object
     *
     * @param object
     * @return \ReflectionObject
     */
    public static function newReflectionObject($object)
    {
        return self::newReflectionClass( self::getClass( $object ) );
    }

    /**
     * Given a class name and a proxy namespace return the proxy name.
     *
     * @param string $className
     * @param string $proxyNamespace
     * @return string
     */
    public static function generateProxyClassName($className, $proxyNamespace)
    {
        return rtrim($proxyNamespace, '\\') . '\\'.Proxy::MARKER.'\\' . ltrim($className, '\\');
    }
}
