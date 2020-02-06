<?php

namespace AlxCart\DI;

use Exception;
use ReflectionClass;
use ReflectionParameter;

trait Resolver
{
	/**
	 * Resolve a class.
	 * 
	 * @param  string $class
	 * @return object  
	 */
	public static function resolve(string $class)
	{
		$reflector = new ReflectionClass($class);
		if (! $reflector->isInstantiable()) {
			throw new Exception("[$class] is not instantiable.");
		}

		$constructor = $reflector->getConstructor();
		if (! $constructor) {
			return new $class;
		}

		foreach ($constructor->getParameters() as $dependency) {
			$class = $dependency->getClass();

			$instances[] = (! $class) 
				? self::resolveNonClassDependency($dependency)
				: self::resolve($class->name); 
		}

		return $reflector->newInstanceArgs($instances ?? []);
	}

	/**
	 * Resolve a non class.
	 * 
	 * @param  ReflectionParameter $parameter
	 * @return mixed
	 * @throws Excetpion
	 */
	private static function resolveNonClassDependency(ReflectionParameter $parameter)
	{
		if ($parameter->isDefaultValueAvailable()) {
			return $parameter->getDefaultValue();
		}

		throw new Exception("[$parameter] cannot be resolved.");
		
	}
}