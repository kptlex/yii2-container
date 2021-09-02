# DI Container

PSR-11 dependency injection container.

[![Latest Stable Version](https://poser.pugx.org/kptlex/container/v)](//packagist.org/packages/kptlex/container)
[![Latest Unstable Version](https://poser.pugx.org/kptlex/container/v/unstable)](//packagist.org/packages/kptlex/container)
[![Build Status](https://github.com/kptlex/container/workflows/build/badge.svg)](https://github.com/kptlex/container/actions)
[![codecov](https://codecov.io/gh/kptlex/container/branch/main/graph/badge.svg?token=S5C6K9Y760)](https://codecov.io/gh/kptlex/container)

This repository contains two containers:

1. CompositeContainer.

   This is a PSR-11 container that works as a link between many other PSR-11 containers.

2. YiiContainer.

   This is a PSR-11 container that works as a link to Yii2 DI container.

# Installation

Use composer.

```
    composer require kptlex/container
```

# Usage

[About PSR-11 Container](https://www.php-fig.org/psr/psr-11/ "Learn more")

### CompositeContainer

```php


use Lex\Container\CompositeContainer;
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
use Lex\Container\YiiContainer;

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
use Lex\Container\YiiContainer;

Yii::$container->setDefinitions([
    ContainerInterface::class => [
        'class' => YiiContainer::class
    ]
]);
```