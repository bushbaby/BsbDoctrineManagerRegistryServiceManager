<?php

/**
 * @copyright Copyright (c) 2016 bushbaby multimedia. (https://bushbaby.nl)
 * @author    Bas Kamer <baskamer@gmail.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace BsbDoctrineRegistryTest\Container;

use BsbDoctrineRegistry\Container\ManagerRegistryFactory;
use BsbDoctrineRegistry\Registry\ManagerRegistry;
use Laminas\ServiceManager\ServiceManager;
use PHPUnit\Framework\TestCase;

class ManagerRegistryFactoryTest extends TestCase
{
    public function testCanCreateInstance(): void
    {
        $container = $this->createMock(ServiceManager::class);

        $container->expects($this->any())
            ->method('get')
            ->with('config')
            ->willReturn([
                'doctrine' => [
                    'connection' => ['orm_default' => []],
                    'entitymanager' => ['orm_default' => []],
                ],
            ]);

        $factory = new ManagerRegistryFactory();
        $managerRegistry = $factory($container);

        $this->assertInstanceOf(ManagerRegistry::class, $managerRegistry);
    }
}
