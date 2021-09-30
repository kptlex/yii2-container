<?php

declare(strict_types=1);

namespace Lex\Yii2\Container;

use Exception;
use Psr\Container\ContainerInterface;
use Yii;

final class YiiContainer implements ContainerInterface
{
    public function get($id)
    {
        try {
            return Yii::$container->get($id);
        } catch (Exception $exception) {
            throw new NotFoundException($exception->getMessage());
        }
    }

    public function has($id): bool
    {
        return Yii::$container->has($id)
            || Yii::$container->hasSingleton($id)
            || class_exists($id);
    }
}