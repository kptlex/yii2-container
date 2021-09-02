<?php

declare(strict_types=1);

namespace Lex\Container\Tests\Data;

use Psr\Container\ContainerInterface;
use Lex\Container\NotFoundException;

class StaticTestContainer implements ContainerInterface
{
    private array $objects;

    public function set(object $object): void
    {
        $this->objects[get_class($object)] = $object;
    }

    public function get($id)
    {
        if (!isset($this->objects[$id])) {
            throw new NotFoundException($id . ' not found');
        }
        return $this->objects[$id];
    }

    public function has($id): bool
    {
        return isset($this->objects[$id]);
    }
}