# RepositoryManagerModule

## Background

In ZF2, we retrieve our repositories like this (example is from a factory):

```php
<?php

public function createService(ServiceLocatorInterface $serviceManager)
{
    $entityManager = $serviceManager->get(\Doctrine\ORM\EntityManager::class);
    $someRepository = $entityManager->getRepository(\Evolver\Entity\SomeEntity::class);
}
```

This has multiple downsides:

1. changing the repositories at runtime is hard because you can't configure the behaviour of the entity manager / entity
manager's `getRepository` method, so you have to invent a "proxy" which then has additional logic when to switch between
your different repositories
2. hard to test: to use an alternative repository you have to mock the getRepository function of the mighty entity
manager
3. hidden dependency: we don't request a dependency from the service manager but from the entity manager
4. no easy using of a factory class to create your repository

## Usage

With the use of this module, the above code transforms into the following:

```php
<?php
// ...
public function createService(ServiceLocatorInterface $serviceManager)
{
    $someRepository = $serviceManager->get(\Evolver\RepositoryManagerModule\Repository\RepositoryManager::class)->get(\Evolver\Entity\SomeEntity::class);
}
```

Now you get a repository depending on your loaded modules and their repository manager configuration.

If you register the Evolver\RepositoryManagerModule\Factory\Doctrine\ObjectRepositoryAbstractFactory::class as abstract factory the request
for the service is proxied to doctrines entity manager `getRepository()` function.

## Configuration

### Configuration Key
The configuration key is `repositories`. Sub-Keys are the same as in every service manager (invokables, factories, ...).

### Examples

In your module class via `getConfig`:

```php
<?php
// ...

    public function getConfig()
    {
        return array(
            'repositories' => array(
                'factories' => array(
                    // your repository factories goes here
                    // format: Entity-Name => Repository-Factory.
                )
            )
        );
    }
```

or via `Evolver\RepositoryManagerModule\ModuleManager\Feature\RepositoryProviderInterface` (method
`getRepositoryConfig`)

```php
<?php
// ...

    public function getRepositoryConfig()
    {
        return array(
            'abstract_factories' => array(
                \Evolver\RepositoryManagerModule\Factory\Doctrine\ObjectRepositoryAbstractFactory::class
            ),
            'factories' => array(
                // your repository factories goes here
            )
        );
    }
```

or via config/autoload/repository-manager.global.config.yaml

```yaml
repositories:
    abstract_factories:
        - "Evolver\RepositoryManagerModule\Factory\Doctrine\ObjectRepositoryAbstractFactory"
    factories:
        # your repository factories goes here
```

## Installation

1. `composer require evolver/repository-manager-module`
2. add `Evolver\RepositoryManagerModule` to the modules array in your application config
