<?php

namespace BsbDoctrineRegistry\Container;

use BsbDoctrineRegistry\Registry\ManagerRegistry;
use Interop\Container\ContainerInterface;

/**
 * Class ManagerRegistryFactory
 */
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

    /**
     * @param array $options
     * @return array
     */
    private function getEntityManagers(array $options)
    {
        $entityManagers = [];
        foreach ($options as $key => $entityManager) {
            $entityManagers[$key] = 'doctrine.entitymanager.' . $key;
        }

        return $entityManagers;
    }

    /**
     * @param array $options
     * @return array
     */
    private function getConnections(array $options)
    {
        $connections = [];
        foreach ($options as $key => $connection) {
            $connections[$key] = 'doctrine.connection.' . $key;
        }

        return $connections;
    }
}
