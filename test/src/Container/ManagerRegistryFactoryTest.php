<?php

namespace BsbDoctrineRegistryTest\Container;

use BsbDoctrineRegistry\Container\ManagerRegistryFactory;
use BsbDoctrineRegistry\Registry\ManagerRegistry;
use Zend\Diactoros\Response;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;

class ManagerRegistryFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testCanCreateInstance()
    {
        $container = $this->getMock(ServiceManager::class);

        $container->expects($this->any())
            ->method('get')
            ->with('config')
            ->willReturn([
                'doctrine' => [
                    'connection'    => ['orm_default' => []],
                    'entitymanager' => ['orm_default' => []],
                ]
            ]);

        $factory         = new ManagerRegistryFactory();
        $managerRegistry = $factory($container);

        $this->assertInstanceOf(ManagerRegistry::class, $managerRegistry);
    }
}
