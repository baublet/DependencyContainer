# DependencyContainer 
For simple dependency injection

## Why?

Sometimes you need dependencies across your application, plugin, or some other system that doesn't itself have a way to handle it (e.g., WordPress). So include this project as a submodule and inject dependencies into your classes at your leisure. Use a container when you don't want to pollute your constructors with a ton of dependencies.

This container also only loads dependencies when a class tries to access the dependency in question. That's why all of our injections are declared as functions. For more information on this, see below.

It's PSR compliant, implementing the [(proposed) Container interfaces](https://github.com/php-fig/fig-standards/blob/master/proposed/container.md) for the API. If the API changes in the interfaces, I'll update these to match.

This means that the API for this is subject to change, so please read any documentation before upgrading.

## Example

I've tried to make the API fairly simple. First, require the container module and declare a new container.

```php
require_once("path/to/DependencyContainer.php");
$dependencies = new DependencyContainer();
```

Dependencies are declared as functions, so that you can ensure your dependencies are only loaded when called. This allows you to use this container as a registry of dependencies in a particular module that, when called, may or may not use all of its dependencies in a given call.

To declare a dependency:

```php
$constructor = "This will be passed to the function as $args";

$dependencies = inject("my-dependency", function($args) {
    require_once("some/big/dependency/class.php");
    return new SomeBigDependencyClass($args);
}, $constructor);
```

In the above code, `some/big/dependency/class.php` is only required and `SomeBigDependencyClass` is only initialized when you call `$dependencies->get("my-dependency");`.

## Testing

This code is tested using Travis CI and plain PHP assertions. No testing framework required. Just hope into the test directory and run the test:

```
cd Test 
php test.php
```