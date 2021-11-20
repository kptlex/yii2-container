<?php

declare(strict_types=1);

namespace Lex\Yii2\Container\Tests\Data;

use Psr\Container\ContainerInterface;
use Lex\Yii2\Container\ContainerException;

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
            throw new ContainerException($id . ' not found');
        }
        return $this->objects[$id];
    }

    public function has($id): bool
    {
        return isset($this->objects[$id]);
    }
}