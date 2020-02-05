<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons\Http;

defined('APP_DIR') or die('No script kiddies please!');

use ReflectionClass;
use InvalidArgumentException;
use LinkAcademy\Gadgets\Commons\Http\Route;
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
     * @var array
     */
    protected $params;

    /**
     * @inheritdoc
     */
    public function setController(string $controller)
    {
        if (class_exists($controller)) {
            $this->controller = $controller;
            return $this;
        }

        throw new InvalidArgumentException(sprintf(
            'The action controller "%s" has not been defined.',
            $controller
        ));
    }

    /**
     * @inheritdoc
     */
    public function setAction(string $action)
    {
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
     */
    public function setParams(string $params)
    {
        $this->params = explode(',', $params);   
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function run(): void
    {
        call_user_func_array([
            new $this->controller, $this->method
        ], $this->params);
    }
}
