<?php

namespace Doctrine\Tests\Common\Util
{
    use Doctrine\Tests\DoctrineTestCase;
    use Doctrine\Common\Util\ClassUtils;

    class ClassUtilsTest extends DoctrineTestCase
    {
        static public function dataGetClass()
        {
            return array(
                array('stdClass', 'stdClass'),
                array('Doctrine\Common\Util\ClassUtils', 'Doctrine\Common\Util\ClassUtils'),
                array( 'MyProject\Proxies\__CG__\stdClass', 'stdClass' ),
                array( 'MyProject\Proxies\__CG__\OtherProject\Proxies\__CG__\stdClass', 'stdClass' ),
                array( 'MyProject\Proxies\__CG__\Doctrine\Tests\Common\Util\ChildObject','Doctrine\Tests\Common\Util\ChildObject' )
            );
        }

        /**
         * @dataProvider dataGetClass
         */
        public function testGetRealClass($className, $expectedClassName)
        {
            $this->assertEquals($expectedClassName, ClassUtils::getRealClass($className));
        }

        /**
         * @dataProvider dataGetClass
         */
        public function testGetClass( $className, $expectedClassName )
        {
            $object = new $className();
            $this->assertEquals($expectedClassName, ClassUtils::getClass($object));
        }

        public function testGetParentClass()
        {
            $parentClass = ClassUtils::getParentClass( 'MyProject\Proxies\__CG__\OtherProject\Proxies\__CG__\Doctrine\Tests\Common\Util\ChildObject' );
            $this->assertEquals('stdClass', $parentClass);
        }

        public function testGenerateProxyClassName()
        {
            $this->assertEquals( 'Proxies\__CG__\stdClass', ClassUtils::generateProxyClassName( 'stdClass', 'Proxies' ) );
        }

        /**
         * @dataProvider dataGetClass
         */
        public function testNewReflectionClass( $className, $expectedClassName )
        {
            $reflClass = ClassUtils::newReflectionClass( $className );
            $this->assertEquals( $expectedClassName, $reflClass->getName() );
        }

        /**
         * @dataProvider dataGetClass
         */
        public function testNewReflectionObject( $className, $expectedClassName )
        {
            $object = new $className;
            $reflClass = ClassUtils::newReflectionObject( $object );
            $this->assertEquals( $expectedClassName, $reflClass->getName() );
        }
    }

    class ChildObject extends \stdClass
    {
    }
}

namespace MyProject\Proxies\__CG__
{
    class stdClass extends \stdClass
    {
    }
}

namespace MyProject\Proxies\__CG__\Doctrine\Tests\Common\Util
{
    class ChildObject extends \Doctrine\Tests\Common\Util\ChildObject
    {
    }
}

namespace MyProject\Proxies\__CG__\OtherProject\Proxies\__CG__
{
    class stdClass extends \MyProject\Proxies\__CG__\stdClass
    {
    }
}

namespace MyProject\Proxies\__CG__\OtherProject\Proxies\__CG__\Doctrine\Tests\Common\Util
{
    class ChildObject extends \MyProject\Proxies\__CG__\Doctrine\Tests\Common\Util\ChildObject
    {
    }
}
