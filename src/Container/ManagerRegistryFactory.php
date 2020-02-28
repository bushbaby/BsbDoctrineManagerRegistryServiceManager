<?php

/**
 * @copyright Copyright (c) 2016 bushbaby multimedia. (https://bushbaby.nl)
 * @author    Bas Kamer <baskamer@gmail.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace BsbDoctrineRegistry\Container;

use BsbDoctrineRegistry\Registry\ManagerRegistry;
use Interop\Container\ContainerInterface;

class ManagerRegistryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $options = $container->get('config');

        $registry = new ManagerRegistry(
            'ORM',
            $this->getConnections($options['doctrine']['connection']),
            $this->getEntityManagers($options['doctrine']['entitymanager']),
            'orm_default',
            'orm_default',
            'Doctrine\ORM\Proxy\Proxy',
            $container
        );

        return $registry;
    }

    private function getEntityManagers(array $options): array
    {
        $entityManagers = [];
        foreach ($options as $key => $entityManager) {
            $entityManagers[$key] = 'doctrine.entitymanager.' . $key;
        }

        return $entityManagers;
    }

    private function getConnections(array $options): array
    {
        $connections = [];
        foreach ($options as $key => $connection) {
            $connections[$key] = 'doctrine.connection.' . $key;
        }

        return $connections;
    }
}
