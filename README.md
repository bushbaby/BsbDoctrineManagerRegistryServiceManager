
# Laminas ServiceManager Doctrine's ManagerRegistry

An implementation Doctrine's ManagerRegistry for laminas/laminas-servicemanager.

##### Install

```bash
composer require "bushbaby/doctrine-managerregistry-servicemanager"
```

Register ManagerRegistryFactory in the service manager.

```php
return [
    'dependencies' => [
        'factories' => [
            \Doctrine\Common\Persistence\ManagerRegistry::class  => BsbDoctrineRegistry\Container\ManagerRegistryFactory::class,
        ],
    ],
];
```

##### Usage

```php
$managerName = 'orm_default';

/** @var \Doctrine\Common\Persistence\ManagerRegistry $managerRegistry */
$managerRegistry = $container->get(\Doctrine\Common\Persistence\ManagerRegistry::class);

/** @var ObjectManager $objectManager */
$objectManager = $managerRegistry->getManager($managerName);

/** @var ObjectRepository $repo */
$repo = $objectManager->getRepository(SomeEntity::class);

```
