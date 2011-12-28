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
 * and is licensed under the LGPL. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\Common\Util;

use ReflectionClass;
use ReflectionProperty;

/**
 * PHP Runtime Reflection Service
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 */
class RuntimeReflectionService implements ReflectionService
{
    /**
     * Return an array of the parent classes (not interfaces) for the given class.
     *
     * @param string $class
     * @return array
     */
    public function getParentClasses($class)
    {
        return class_parents($class);
    }

    /**
     * Return the shortname of a class.
     *
     * @param string $class
     * @return string
     */
    public function getClassShortName($class)
    {
        $r = new ReflectionClass($class);
        return $r->getShortName();
    }

    /**
     * @param string $class
     * @return string
     */
    public function getClassNamespace($class)
    {
        $r = new ReflectionClass($class);
        return $r->getNamespaceName();
    }

    /**
     * Return a reflection class instance or null
     *
     * @param string $class
     * @return ReflectionClass|null
     */
    public function getClass($class)
    {
        return new ReflectionClass($class);
    }

    /**
     * Return an accessible property (setAccessible(true)) or null.
     *
     * @param string $class
     * @param string $property
     * @return ReflectionProperty|null
     */
    public function getAccessibleProperty($class, $property)
    {
        $property = new ReflectionProperty($class, $property);
        $property->setAccessible(true);
        return $property;
    }

    /**
     * Check if the class have a public method with the given name.
     *
     * @param mixed $class
     * @param mixed $method
     * @return bool
     */
    public function hasPublicMethod($class, $method)
    {
        return method_exists($class, $method) && is_callable(array($class, $method));
    }
}

