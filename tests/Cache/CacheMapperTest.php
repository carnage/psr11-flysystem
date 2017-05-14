<?php
declare(strict_types=1);

namespace WShafer\PSR11FlySystem\Test\Cache;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use WShafer\PSR11FlySystem\Cache\CacheMapper;
use WShafer\PSR11FlySystem\Cache\MemoryCacheFactory;
use WShafer\PSR11FlySystem\Cache\Psr6CacheFactory;

/**
 * @covers \WShafer\PSR11FlySystem\Cache\CacheMapper
 */
class CacheMapperTest extends TestCase
{
    public function testGetFactoryClassNamePSR6()
    {
        $container = $this->createMock(ContainerInterface::class);
        $cacheMapper = new CacheMapper($container);
        $result = $cacheMapper->getFactoryClassName('psr6');
        $this->assertEquals(Psr6CacheFactory::class, $result);
    }

    public function testGetFactoryClassNameMemory()
    {
        $container = $this->createMock(ContainerInterface::class);
        $cacheMapper = new CacheMapper($container);
        $result = $cacheMapper->getFactoryClassName('memory');
        $this->assertEquals(MemoryCacheFactory::class, $result);
    }

    public function testGetFactoryClassNameByFullClass()
    {
        $container = $this->createMock(ContainerInterface::class);
        $cacheMapper = new CacheMapper($container);
        $result = $cacheMapper->getFactoryClassName(MemoryCacheFactory::class);
        $this->assertEquals(MemoryCacheFactory::class, $result);
    }

    public function testGetFactoryClassNameNotFound()
    {
        $container = $this->createMock(ContainerInterface::class);
        $cacheMapper = new CacheMapper($container);
        $result = $cacheMapper->getFactoryClassName('Oops-Not-Found');
        $this->assertNull($result);
    }

    /**
     * @expectedException \TypeError
     */
    public function testGetFactoryClassNameOnlyAcceptsStrings()
    {
        $container = $this->createMock(ContainerInterface::class);
        $cacheMapper = new CacheMapper($container);
        $cacheMapper->getFactoryClassName(123);
    }
}