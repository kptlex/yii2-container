<?php

declare(strict_types=1);

namespace Lex\Container;

use Psr\Container\ContainerInterface;

final class CompositeContainer implements ContainerInterface
{
    /**
     * @var ContainerInterface[]
     */
    private array $containers = [];

    /**
     * Added a container to composite container.
     * @param ContainerInterface $container
     */
    public function add(ContainerInterface $container): void
    {
        array_unshift($this->containers, $container);
    }

    public function get($id)
    {
        $value = null;
        foreach ($this->containers as $container) {
            if ($container->has($id)) {
                return $container->get($id);
            }
        }
        throw new NotFoundException("No definition for $id");
    }

    public function has($id): bool
    {
        foreach ($this->containers as $container) {
            if ($container->has($id)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Removes a container from the container list.
     * @param ContainerInterface $container
     */
    public function remove(ContainerInterface $container): void
    {
        foreach ($this->containers as $index => $adapter) {
            if ($container === $adapter) {
                unset($this->containers[$index]);
            }
        }
    }
}