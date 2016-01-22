<?php

namespace BsbDoctrineRegistry\Registry;

use Doctrine\Common\Persistence\AbstractManagerRegistry;
use Doctrine\ORM\ORMException;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * Class ManagerRegistry
 */
class ManagerRegistry extends AbstractManagerRegistry
{
    /**
     * @var ServiceManager
     */
    private $serviceManager;

    /**
     * @inheritdoc
     *
     * @param ServiceManager $container
     */
    public function __construct(
        $name,
        array $connections,
        array $managers,
        $defaultConnection,
        $defaultManager,
        $proxyInterfaceName,
        ServiceManager $serviceManager
    ) {
        parent::__construct($name, $connections, $managers, $defaultConnection, $defaultManager, $proxyInterfaceName);

        $this->serviceManager = $serviceManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function getService($name)
    {
        return $this->serviceManager->get($name);
    }

    /**
     * {@inheritdoc}
     */
    protected function resetService($name)
    {
        $this->serviceManager->setService($name, null);
    }

    /**
     * {@inheritdoc}
     */
    public function getAliasNamespace($alias)
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
