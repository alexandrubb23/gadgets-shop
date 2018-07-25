<?php

namespace LinkAcademy\Gadgets\Commons\Http;

use ReflectionClass;
use InvalidArgumentException;
use LinkAcademy\Gadgets\Commons\Twig;
use LinkAcademy\Gadgets\Commons\Http\AbstractController;
use LinkAcademy\Gadgets\Commons\Contracts\ControllerInterface;

class Controller implements ControllerInterface
{
	/**
	 * Default controller
	 */
	const DEFAULT_CONTROLLER = 'Home';

	/**
	 * Default action
	 */
	const DEFAULT_ACTION = 'index';

	/**
	 * Controller
	 * 
	 * @var string
	 */
	protected $controller = self::DEFAULT_CONTROLLER;

	/**
	 * Action
	 * 
	 * @var string
	 */
	protected $action = self::DEFAULT_ACTION;

	/**
	 * Params 
	 * 
	 * @var array
	 */
	protected $params = [];

	/**
	 * App directory
	 * 
	 * @var string
	 */
	protected $basePath = APP_DIR;

	/**
	 * Class constructor
	 * 
	 * @param array $options Controller options
	 */
	public function __construct(array $options = [])
	{
		if (empty($options)) {
			$this->parseUri();
		} else {
			if (isset($options['controller'])) {
				$this->setController($options['controller']);
			}

			if (isset($options['action'])) {
				$this->setAction($options['action']);
			}

			if (isset($options['params'])) {
				$this->setParams($options['params']);
			}
		}
	}

	/**
	 * Parse uri
	 * 
	 * @return void
	 */
	protected function parseUri()
	{
		$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
		$path = preg_replace("/[^a-zA-Z0-9\/]/", '', $path);

		if (strpos($path, $this->basePath) === 0) {
			$path = substr($path, strlen($this->basePath));
		}

		@list($controller, $action, $params) = explode('/', $path, 3);

		if (isset($controller)) {
			$this->setController($controller);
		}

		if (isset($action)) {
			$this->setAction($action);
		}

		if (isset($params)) {
			$this->setParams($params);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function setController(string $controller)
	{
		$controller = ! $controller
			? $this->controller
			: $controller
		;

		$controller = ucfirst(strtolower($controller)) . 'Controller';

		$class = self::getFullClassName($controller);
		if (class_exists($class)) {
			$this->controller = $class;
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
		$reflection = new ReflectionClass($this->controller);
		if ($reflection->hasMethod($action)) {
			$this->action = $action;
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

		call_user_func_array([$controller, $this->action], $this->params);
	}

	/**
	 * Get full class name including namespace
	 * 
	 * @param  string $controller Short class name
	 * @return string
	 */
	private static function getFullClassName($controller)
	{
		return __NAMESPACE__ . '\\' . $controller;
	}
}