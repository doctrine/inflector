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

namespace Doctrine\Tests\Common\Util;

use Doctrine\Common\Util\RuntimeReflectionService;

/**
 * @group DCOM-93
 */
class RuntimeReflectionServiceTest extends \PHPUnit_Framework_TestCase
{
    private $reflectionService;

    public function setUp()
    {
        $this->reflectionService = new RuntimeReflectionService();
    }

    public function testShortname()
    {
        $this->assertEquals("RuntimeReflectionServiceTest", $this->reflectionService->getClassShortName(__CLASS__));
    }

    public function testClassNamespaceName()
    {
        $this->assertEquals("Doctrine\Tests\Common\Util", $this->reflectionService->getClassNamespace(__CLASS__));
    }

    public function testGetParentClasses()
    {
        $classes = $this->reflectionService->getParentClasses(__CLASS__);
        $this->assertTrue(count($classes) >= 1, "The test class ".__CLASS__." should have at least one parent.");
    }

    public function testGetReflectionClass()
    {
        $class = $this->reflectionService->getClass(__CLASS__);
        $this->assertInstanceOf("ReflectionClass", $class);
    }

    public function testGetMethods()
    {
        $this->assertTrue($this->reflectionService->hasPublicMethod(__CLASS__, "testGetMethods"));
        $this->assertFalse($this->reflectionService->hasPublicMethod(__CLASS__, "testGetMethods2"));
    }

    public function testGetAccessibleProperty()
    {
        $reflProp = $this->reflectionService->getAccessibleProperty(__CLASS__, "reflectionService");
        $this->assertInstanceOf("ReflectionProperty", $reflProp);
    }
}

