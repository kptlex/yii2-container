<?php

declare(strict_types=1);

namespace Lex\Yii2\Container;

use Psr\Container\ContainerExceptionInterface;
use yii\base\Exception;

final class ContainerException extends Exception implements ContainerExceptionInterface
{
}