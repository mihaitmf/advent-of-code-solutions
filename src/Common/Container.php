<?php

namespace AdventOfCode\Common;

use DI\Cache\ArrayCache;
use DI\ContainerBuilder;

class Container
{
    /** @var \DI\Container */
    private static $container;

    private function __construct()
    {
    }

    /**
     * @param string $name
     *
     * @return mixed
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public static function get($name)
    {
        if (self::$container === null) {
            self::$container = self::buildContainer();
        }

        return self::$container->get($name);
    }

    /**
     * @param string $name
     * @param array $parameters
     *
     * @return mixed
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public static function make($name, array $parameters = [])
    {
        if (self::$container === null) {
            self::$container = self::buildContainer();
        }

        return self::$container->make($name, $parameters);
    }

    /**
     * @return \DI\Container
     */
    private static function buildContainer()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->setDefinitionCache(new ArrayCache());

        return $containerBuilder->build();
    }
}
