<?php

namespace Doctrine\Tests\Common\Util;

use Doctrine\Tests\DoctrineTestCase;
use Doctrine\Common\Util\Debug;

class DebugTest extends DoctrineTestCase
{
    public function testExportObject( )
    {
        $obj = new \stdClass;
        $obj->foo = "bar";
        $obj->bar = 1234;

        $var = Debug::export($obj, 2);
        $this->assertEquals( "stdClass", $var->__CLASS__ );
    }

    public function testExportDateTime()
    {
        $obj = new \DateTime( "2010-10-10 10:10:10" );

        $var = Debug::export( $obj, 2 );
        $this->assertEquals( "DateTime", $var->__CLASS__ );
    }
}
