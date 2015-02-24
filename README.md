# Repository Manager

## Background

In ZF2, we retrieve our repositories like this (example is from a factory):

```php
public function createService(ServiceLocatorInterface $serviceManager)
{
    $entityManager = $serviceManager->get('Doctrine\\ORM\\EntityManager');
    $someRepository = $entityManager->getRepository('SomeEntity');
}
```

This has multiple downsides:

1. changing the repositories at runtime is hard because you can't configure the behaviour of the
entitymanager / entitymanager's getRepository function, so you have to invent a "proxy"
which then has additional logic when to switch between your different repositories
2. hard to test: to use an alternative repository you have to mock the getRepository function of the mighty entitymanager
3. hidden dependency: we don't request a dependency from the service manager but from the entitymanager
4. no easy using of a factory class to create your repository

## Usage

With the use of this module, the above code transforms into the following:

```php
<?php
// ...
public function createService(ServiceLocatorInterface $serviceManager)
{
    $someRepository = $serviceManager->get('RepositoryManager')->get('SomeEntity');
}
```

Now you get a repository depending on your loaded modules and their repositorymanager configuration.

If no one configures the RepositoryManager, an abstract factory is called which just proxies the request to doctrines
entitymanager getRepository function.

## Configuration

### Configuration Key
The configuration key is `repositories`. Sub-Keys are the same as in every service manager (invokables, factories, ...).

### Examples

In your module class via getConfig:

```php
<?php
// ...

    public function getConfig()
    {
        return array(
            'repositories' => array(
                'factories' => array(
                    // your repository factories goes here
                    // format: Entity-Name: Repository-Factory.
                )
            )
        );
    }
```

or via Evolver\RepositoryManager\ModuleManager\Feature\RepositoryProviderInterface (getRepositoryConfig)

```php
<?php
// ...

    public function getRepositoryConfig()
    {
        return array(
            'factories' => array(
                // your repository factories goes here
            )
        );
    }
```

or via config/autoload/repositorymanager.global.config.yaml

```yaml
repositories:
    factories:
        # your repository factories goes here
```
