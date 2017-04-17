<?php

namespace baublet\DependencyContainer\Exception;

class DependencyContainerException extends \Exception implements \baublet\DependencyContainer\Psr\Container\Exception\ContainerExceptionInterface
{
    // Redefine the exception so message isn't optional
    public function __construct($id, \Exception $exception, $code = 0)
    {
        $message = "Error retrieving the entry: " . $id . "\nThrew an exception with the message: " . $exception->getMessage();
        parent::__construct($message, $code, $exception);
    }
}