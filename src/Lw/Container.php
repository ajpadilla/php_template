<?php

namespace Template\Php;

use Psr\Container\ContainerInterface;
use Template\Php\Exception\ContainerException;
use Template\Php\Exception\NotFoundException;

class Container implements ContainerInterface
{
    private array $entries = [];

    /**
     * @throws \ReflectionException
     * @throws ContainerException
     */
    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];
            return $entry($this);
        }
       return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $concrete)
    {
        $this->entries[$id] = $concrete;
    }

    /**
     * @throws \ReflectionException
     * @throws ContainerException
     */
    public function resolve(string $id)
    {
        // 1. Inspect the class that we are trying to get from the container
        $reflectionClass = new \ReflectionClass($id);

        if(!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Class {$id} is not instantiable");
        }

        // 2. Inspect the constructor of the class
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $id;
        }

        // 3. Inspect the constructor parameters (dependencies)
        $parameters = $constructor->getParameters();
        if (!$parameters) {
            return new $id;
        }
        // 4. If the constructor parameters is a class them try to resolve that class using the container
        $dependencies = array_map(function (\ReflectionParameter $params) use ($id) {
            $name = $params->getName();
            $type = $params->getType();

            if (!$type) {
                throw new ContainerException("Failed to resolver class {$id} because param {$name} is missing a type hint");
            }

            if ($type instanceof \ReflectionUnionType) {
                throw new ContainerException("Failed to resolver class {$id} because union type for param {$name}");
            }

            if ($type instanceof \ReflectionNamedType) {
                return $this->get($type->getName());
            }

        }, $parameters);

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}