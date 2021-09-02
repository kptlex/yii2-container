<?php

declare(strict_types=1);

namespace Lex\Container\Tests;

use Lex\Container\{CompositeContainer,
    NotFoundException,
    Tests\Data\Service,
    Tests\Data\StaticTestContainer,
    YiiContainer
};
use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Yii;
use yii\di\Container;

class CompositeContainerTest extends TestCase
{
    public const TEST_VALUE = 10;

    /**
     * @covers Lex\Container\YiiContainer
     * @covers Lex\Container\NotFoundException
     */
    public function testYiiContainer(): void
    {
        $yiiContainer = $this->yiiContainer();
        $this->process($yiiContainer);
    }

    /**
     * @covers \Container\CompositeContainer
     * @covers \Container\YiiContainer
     * @covers \Container\NotFoundException
     */
    public function testCompositeContainerYii(): void
    {
        $compositeContainer = new CompositeContainer();
        $yiiContainer = $this->yiiContainer();
        $compositeContainer->add($yiiContainer);
        $this->process($compositeContainer);
        $compositeContainer->remove($yiiContainer);
        self::assertNotTrue($compositeContainer->has(Service::class));
    }


    /**
     * @covers \Container\CompositeContainer
     * @covers \Container\YiiContainer
     * @covers \Container\NotFoundException
     */
    public function testCompositeContainerTwo(): void
    {
        $compositeContainer = $this->compositeTwoContainer();
        $this->process($compositeContainer);
    }

    private function process(ContainerInterface $container): void
    {
        self::assertTrue($container->has(Service::class));
        self::assertNotEmpty($container->get(Service::class));
        $class = __CLASS__ . 'T';
        self::assertNotTrue($container->has($class));
        try {
            $container->get($class);
        } catch (Exception $exception) {
            self::assertSame(get_class($exception), NotFoundException::class);
        }
    }


    private function getTestContainer($container = null): StaticTestContainer
    {
        $testContainer = new StaticTestContainer();
        $service = new Service($container ?: $testContainer);
        $testContainer->set($service);
        $testContainer->set($testContainer);
        return $testContainer;
    }

    /**
     * @uses testCompositeContainerTwo
     */
    private function compositeTwoContainer(): CompositeContainer
    {
        $compositeContainer = new CompositeContainer();
        $testContainer = $this->getTestContainer($compositeContainer);
        $yiiContainer = $this->yiiContainer();
        Yii::$container->set(ContainerInterface::class, $compositeContainer);
        $compositeContainer->add($yiiContainer);
        $compositeContainer->add($testContainer);
        return $compositeContainer;
    }

    private function yiiContainer(): YiiContainer
    {
        Yii::$container = new Container();
        Yii::$container->setSingletons([
            ContainerInterface::class => YiiContainer::class
        ]);
        return new YiiContainer();
    }
}
