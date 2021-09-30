<?php

declare(strict_types=1);

namespace Lex\Yii2\Container;

use Psr\Container\NotFoundExceptionInterface;
use yii\base\Exception;

final class NotFoundException extends Exception implements NotFoundExceptionInterface
{
}