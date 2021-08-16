
# Laminas ServiceManager Doctrine's ManagerRegistry

[![Build Status](https://travis-ci.com/bushbaby/BsbDoctrineManagerRegistryServiceManager.svg?branch=master)](https://travis-ci.com/bushbaby/BsbDoctrineManagerRegistryServiceManager)

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
            \Doctrine\Persistence\ManagerRegistry::class  => BsbDoctrineRegistry\Container\ManagerRegistryFactory::class,
        ],
    ],
];
```

##### Usage

```php
$managerName = 'orm_default';

/** @var \Doctrine\Persistence\ManagerRegistry $managerRegistry */
$managerRegistry = $container->get(\Doctrine\Persistence\ManagerRegistry::class);

/** @var ObjectManager $objectManager */
$objectManager = $managerRegistry->getManager($managerName);

/** @var ObjectRepository $repo */
$repo = $objectManager->getRepository(SomeEntity::class);

```
