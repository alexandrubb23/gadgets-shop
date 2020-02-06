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
     * [__call description]
     * @param  [type] $method [description]
     * @param  [type] $args   [description]
     * @return [type]         [description]
     */
    public function __call($method, $args)
    {
        preg_match('/(?<controller>\w+)@(?<method>\w+)/', $this->action, $matches);
        if (empty($matches)) {
            return;
        }
        
        return $matches[$method];
    }

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
    public function setMethod(string $method)
    {
        $reflection = new ReflectionClass($this->controller);
        if ($reflection->hasMethod($method)) {
            $this->method = $method;
            return $this;
        }

        throw new InvalidArgumentException(sprintf(
            'The controller method "%s" has been not defined.',
            $method
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
    public function call(): void
    {
        call_user_func_array([
            new $this->controller, $this->method
        ], $this->params);
    }
}
