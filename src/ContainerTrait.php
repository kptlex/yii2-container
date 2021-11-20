<?php

declare(strict_types=1);

namespace Lex\Yii2\Container;

use Psr\Container\ContainerInterface;
use Yii;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

trait ContainerTrait
{
    /**
     * @return ContainerInterface
     * @throws ContainerException
     */
    protected function getContainer(): ContainerInterface
    {
        try {
            return Yii::$container->get(ContainerInterface::class);
        } catch (NotInstantiableException|InvalidConfigException $e) {
            throw new ContainerException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }
}