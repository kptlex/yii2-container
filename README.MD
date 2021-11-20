# DI Container

This is a PSR-11 container that works as a link to Yii2 DI container.

[![Latest Stable Version](https://poser.pugx.org/kptlex/yii2-container/v)](//packagist.org/packages/kptlex/yii2-container)
[![Latest Unstable Version](https://poser.pugx.org/kptlex/yii2-container/v/unstable)](//packagist.org/packages/kptlex/container)
[![Build Status](https://github.com/kptlex/yii2-container/workflows/build/badge.svg)](https://github.com/kptlex/yii2-container/actions)
[![codecov](https://codecov.io/gh/kptlex/yii2-container/branch/main/graph/badge.svg?token=8QNr91A4VZ)](https://codecov.io/gh/kptlex/yii2-container)

This repository contains two containers:

# Installation

Use composer.

```
    composer require kptlex/yii2-container
```

# Usage

[About PSR-11 Container](https://www.php-fig.org/psr/psr-11/ "Learn more")

### CompositeContainer

```php


use Lex\Yii2\Container\CompositeContainer;
use Psr\Container\ContainerInterface;

/**
 * @var ContainerInterface[] $anotherContainers
 */

$container = new CompositeContainer();

foreach ($anotherContainers as $anotherContainer) {
    $container->add($anotherContainer);
}

```

### YiiContainer

Added to yii2

Config:

```php

use Psr\Container\ContainerInterface; 
use Lex\Yii2\Container\YiiContainer;

return [
    'container' => [
        'definitions' => [
            ContainerInterface::class => [
                'class' => YiiContainer::class
            ]
        ]
    ]
];
```

or Yii::$container:

```php

use Psr\Container\ContainerInterface; 
use Lex\Yii2\Container\YiiContainer;

Yii::$container->setDefinitions([
    ContainerInterface::class => [
        'class' => YiiContainer::class
    ]
]);
```
