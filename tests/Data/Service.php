<?php

declare(strict_types=1);

namespace Lex\Container\Tests\Data;

use Psr\Container\ContainerInterface;

class Service
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}