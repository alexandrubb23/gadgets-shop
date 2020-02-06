<?php

namespace LinkAcademy\Gadgets\Commons\Support\Facades;

defined('APP_DIR') or die('No script kiddies please!');

use RuntimeException;

abstract class Facade
{
    /**
     * The resolved object instances.
     *
     * @var array
     */
    protected static $resolvedInstance;

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    abstract protected static function getFacadeAccessor(): string;

    /**
     * Get the root object behind the faced.
     *
     * @return mixed
     */
    public static function getFacadeRoot(): object
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    /**
     * Resolve the facade root instance from the container.
     *
     * @param  string|object $name [description]
     * @return mixed
     *
     * @todo Get rid of the container - 07.06.2018
     */
    protected static function resolveFacadeInstance($name): object
    {
        if (is_object($name)) {
            return $name;
        }

        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }
        
        return static::$resolvedInstance[$name] = new $name;
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param  string $method
     * @param  array  $args
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();
        if (! $instance) {
            throw new RuntimeException('A facade root has not been set.');
        }
        
        return $instance->$method(...$args);
    }
}
