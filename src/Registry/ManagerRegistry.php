<?php

/**
 * @copyright Copyright (c) 2016 bushbaby multimedia. (https://bushbaby.nl)
 * @author    Bas Kamer <baskamer@gmail.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace BsbDoctrineRegistry\Registry;

use Doctrine\ORM\ORMException;
use Doctrine\Persistence\AbstractManagerRegistry;
use Interop\Container\ContainerInterface;

class ManagerRegistry extends AbstractManagerRegistry
{
    /**
     * @var ContainerInterface
     */
    private $serviceManager;

    /**
     * @inheritdoc
     */
    public function __construct(
        $name,
        array $connections,
        array $managers,
        $defaultConnection,
        $defaultManager,
        $proxyInterfaceName,
        ContainerInterface $container
    ) {
        parent::__construct($name, $connections, $managers, $defaultConnection, $defaultManager, $proxyInterfaceName);

        $this->serviceManager = $container;
    }

    /**
     * @inheritdoc
     */
    protected function getService($name)
    {
        return $this->serviceManager->get($name);
    }

    /**
     * @inheritdoc
     */
    protected function resetService($name): void
    {
        $this->serviceManager->setService($name, null);
    }

    /**
     * @inheritdoc
     */
    public function getAliasNamespace($alias): string
    {
        foreach (array_keys($this->getManagers()) as $name) {
            try {
                return $this->getManager($name)->getConfiguration()->getEntityNamespace($alias);
            } catch (ORMException $e) {
            }
        }

        throw ORMException::unknownEntityNamespace($alias);
    }
}
