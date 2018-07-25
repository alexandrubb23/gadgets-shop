<?php

namespace LinkAcademy\Gadgets\Commons\Http;

use ReflectionClass;
use InvalidArgumentException;
use LinkAcademy\Gadgets\Commons\Twig;
use LinkAcademy\Gadgets\Commons\Http\Route;
use LinkAcademy\Gadgets\Commons\Http\AbstractController;
use LinkAcademy\Gadgets\Commons\Contracts\ControllerInterface;

class Controller implements ControllerInterface
{
	/**
	 * @var string
	 */
	protected $controller;

	/**
	 * @var string
	 */
	protected $method;

	/**
	 * @var string
	 */
	protected $uri;

	/**
	 * @var string
	 */
	protected $action;

	/**
	 * Params 
	 * 
	 * @var array
	 */
	protected $params = [];

	/**
	 * @inheritdoc
	 */
	public function setController(string $controller)
	{
		// var_dump('Set controller ' . $controller);
		if (class_exists($controller)) {
			$this->controller = $controller;
			return $this;
		}

		throw new InvalidArgumentException(sprintf(
			'The action controller "%s" has not been defined.',
			$class
		));
	}

	/**
	 * @inheritdoc
	 *
	 * @throws InvalidArgumentException
	 */
	public function setAction(string $action)
	{
		// var_dump('Set action ' . $action);
		$reflection = new ReflectionClass($this->controller);
		if ($reflection->hasMethod($action)) {
			$this->method = $action;
			return $this;
		}

		throw new InvalidArgumentException(sprintf(
			'The controller action "%s" has been not defined.',
			$action
		));
	}

	/**
	 * @inheritdoc
	 *
	 * @throws InvalidArgumentException
	 */
	public function setParams($params)
	{
		if (! $params) {
			return;	
		}

		if (! is_array($params)) {
			$params = explode(',', $params);
		}

		$this->params = $params;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		$controller = new $this->controller(Twig::get());
		if (! $controller instanceof AbstractController) {
			throw new \Exception(sprintf(
				'The class "%s" must implements "%s"',
				get_class($controller),
				AbstractController::class
			));
		}
		
		call_user_func_array([$controller, $this->method], $this->params);
	}
}