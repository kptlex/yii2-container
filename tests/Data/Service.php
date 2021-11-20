<?php

declare(strict_types=1);

namespace Lex\Yii2\Container\Tests\Data;

use Lex\Yii2\Container\ContainerTrait;
use Psr\Container\ContainerInterface;

class Service
{
    private ContainerInterface $container;

    use ContainerTrait;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getTraitContainer(): ContainerInterface
    {
        return $this->getContainer();
    }

    public function getCurrentContainer(): ContainerInterface
    {
        return $this->container;
    }
}