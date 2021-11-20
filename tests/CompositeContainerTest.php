<?php

declare(strict_types=1);

namespace Lex\Yii2\Container\Tests;

use Lex\Yii2\Container\ContainerException;
use Lex\Yii2\Container\Tests\Data\Service;
use Lex\Yii2\Container\Tests\Data\StaticTestContainer;
use Lex\Yii2\Container\YiiContainer;
use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Yii;
use yii\di\Container;

class CompositeContainerTest extends TestCase
{
    public const TEST_VALUE = 10;

    /**
     * @covers Lex\Yii2\Container\YiiContainer
     * @covers Lex\Yii2\Container\ContainerException
     * @covers Lex\Yii2\Container\ContainerTrait
     */
    public function testYiiContainer(): void
    {
        $yiiContainer = $this->yiiContainer();
        $this->process($yiiContainer);


    }

    private function process(ContainerInterface $container): void
    {
        self::assertTrue($container->has(Service::class));
        /** @var Service $service */
        $service = $container->get(Service::class);
        self::assertNotEmpty($service);
        self::assertNotEmpty($service->getTraitContainer());
        $class = __CLASS__ . 'T';
        self::assertNotTrue($container->has($class));
        try {
            $container->get($class);
        } catch (Exception $exception) {
            self::assertSame(get_class($exception), ContainerException::class);
        }
        Yii::$container->set(ContainerInterface::class, [
            'class' => self::class
        ]);
        $this->expectException(ContainerException::class);
        $service->getTraitContainer();
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
