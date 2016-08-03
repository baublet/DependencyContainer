<?php

namespace DependencyContainer\Exception;

class DependencyContainerNotFoundException extends \Exception implements \DependencyContainer\Psr\Container\Exception\NotFoundExceptionInterface
{
    // Redefine the exception so message isn't optional
    public function __construct($id, $code = 0, \Exception $previous = null)
    {
        parent::__construct("Dependency \"" . $id . "\" not found. Make sure it is properly injected in this domain", $code, $previous);
    }
}